<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;
use Application\Settlement\Factory;
use Application\Pdf\Creator;

class SettlementsController extends Zend_Controller_Action
{
	private $_settlementTotals = array();

    public function indexAction()
    {
    	$this->getHelper("paginator")->paginate("SettlementTotal");
    	$this->view->filter = new Filter_Form_Settlements();
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam("id");
    	$where = "settlement_total_id = " . $id;
    	$this->getHelper("paginator")->paginate("Settlement", $where);

    	$this->view->settlementId = $id;
    }

    public function settleAction()
    {
		$em = EntityManager::getInstance();
		$dataMapper = $em->getDataMapper("Application");
		$select = $dataMapper->getDbTable()->select(false)
			->from($dataMapper->getDbTable()->info("name"), $dataMapper->getDbTable()->info("primary"))
			->joinNatural("application_statuses", array())
			->where("application_statuses.taken_to_settle = 1")
			->where("application_statuses.active = 1")
			->where("applications.premium_type_id IS NOT NULL")
			->where("applications.settled = 0");

		$id = $this->getRequest()->getParam("id");
		if ($id) {
		    $select->where("applications.employee_id = ?", $id);
		}
		$applications = $em->findAll("Application", $select);

		foreach ($applications as $application) {
			$settlementStrategy = Factory::factory($application->settlementType->engine);
			$where = "application_id = " . $application->getIdentifier() . " AND parts IS NOT NULL";
			$settlementHistory = $em->findAll("Settlement", $where);

			if ($application->seller->getIdentifier() == null) {
			    $application->seller = $application->employee;
			}

			if (count($settlementHistory) == 0) {
				$this->_createApplicationPercents($application);
				$this->_createApplicationSettlement($application);
			}

			$settlementStrategy->application = $application;
			$settlementStrategy->history = $settlementHistory;
			$settlementStrategy->configuration = $application->applicationSettlement->current()->configuration;

			$settlementStrategy->employee = $application->seller;
			$percent = $this->_getPercentForSeller($application, $application->seller);
			$settlementStrategy->percent = $percent;

			$amount = $settlementStrategy->settle();
			$parts = ($settlementHistoryCounter + 1) . "/" . $settlementStrategy->getParts();
			$parts .= " sprzedaż umowy";
			$this->_createSettlement($application, $application->seller, $amount, $parts);

			$employees = array();
			$employee = $application->employee;
			while ($employee->getIdentifier()) {
				if (in_array($employee->getIdentifier(), $employees)) break;

				$percent = $this->_getPercentForEmployee($application, $employee);
				$settlementStrategy->employee = $employee;
				$settlementStrategy->percent = $percent;

				$amount = $settlementStrategy->settle();
				$settlementHistoryCounter = $this->_getSettlementHistoryCountForEmployee($settlementHistory, $employee);
				$parts = ($settlementHistoryCounter + 1) . "/" . $settlementStrategy->getParts();
				$this->_createSettlement($application, $employee, $amount, $parts);

				$employees[] = $employee->getIdentifier();
				$employee = $employee->parentEmployee;
			}

			if (count($settlementHistory) + 1 == $settlementStrategy->parts) {
				$application->settled = 1;
				$em->persist($application);
			}
		}

		foreach ($this->_settlementTotals as $settlementTotal) {
			$configuration = $model = $em->create("Configuration");
			$amount = $settlementTotal->total;

			if ($amount > $configuration->taxFreeAllowance) {
				$tax =  ($amount - $configuration->taxFreeAllowance) * $configuration->taxPercent / 100;
				$settlementTotal->tax = $tax;
			}

			$em->persist($settlementTotal);
		}

		$this->_redirect("/settlements");
    }

    private function _createApplicationPercents(\Model\Application $application)
    {
    	$em = EntityManager::getInstance();

    	$percent = $application->product->sellerPercent;
    	$forSeller = 1;

        $this->_createApplicationPercent($application, $application->seller, $percent, $forSeller);

    	$employees = array();
    	$percents = $application->product->percents;
    	$employee = $application->employee;

    	while ($employee->getIdentifier()) {
    		if (in_array($employee->getIdentifier(), $employees)) break;

    		foreach ($percents as $percent) {
    			if ($employee->position == $percent->employeePosition) {
    				$this->_createApplicationPercent($application, $employee, $percent);
    				break;
    			}
    		}

    		$employees[] = $employee->getIdentifier();
    		$employee = $employee->parentEmployee;
    	}
    }

    private function _createApplicationSettlement(\Model\Application $application)
    {
    	$em = EntityManager::getInstance();
    	$model = new \Model\ApplicationSettlement();
    	$model->application = $application;

    	$configuration = new Zend_Config_Ini(APPLICATION_PATH . "/configs/configuration.ini");
    	$model->configuration = $configuration->toArray();
    	$em->persist($model);
    }

    private function _createApplicationPercent(
    	\Model\Application $application,
    	\Model\Employee $employee,
    	$percent,
    	$forSeller = 0
    )
    {
    	if ($percent instanceof \Model\ProductSettlementPercent) {
    		$percent = $percent->value;
    	}

    	$em = EntityManager::getInstance();
    	$applicationPercent = $em->create("ApplicationPercent");
    	$applicationPercent->application = $application;
    	$applicationPercent->employee = $employee;
    	$applicationPercent->percent = $percent;
    	$applicationPercent->forSeller = $forSeller;
    	$em->persist($applicationPercent);
    }

    private function _getPercentForEmployee(\Model\Application $application, \Model\Employee $employee, $forSeller = false)
    {
		foreach ($application->percents as $applicationPercent) {
			if ($applicationPercent->forSeller == $forSeller && $applicationPercent->employee == $employee) {
				return $applicationPercent->percent;
			}
		}

    	return 0;
    }

    private function _getPercentForSeller(\Model\Application $application, \Model\Employee $employee)
    {
    	return $this->_getPercentForEmployee($application, $employee, true);
    }

    private function _getSettlementHistoryCountForEmployee($settlementHistory, \Model\Employee $employee)
    {
		$counter = 0;
		foreach ($settlementHistory as $settlement) {
			if ($settlement->employee == $employee) {
				$counter++;
			}
		}

		return $counter;
    }

    private function _createSettlement(\Model\Application $application, \Model\Employee $employee, $amount, $parts = null)
    {
    	if (empty($amount) == false) {
			$settlementTotal = $this->_findSettlementTotal($employee);

	    	$em = EntityManager::getInstance();
	    	$settlement = $em->create("Settlement");
			$settlement->application = $application;
			$settlement->settlementTotal = $settlementTotal;
			$settlement->employee = $employee;
			$settlement->amount = $amount;
			$settlement->parts = $parts;
	    	$em->persist($settlement);

	    	$settlementTotal->total += $amount;
    	}
    }

    private function _findSettlementTotal(\Model\Employee $employee)
    {
		foreach ($this->_settlementTotals as $settlementTotal) {
			if ($settlementTotal->employee == $employee) {
				return $settlementTotal;
			}
		}

		$em = EntityManager::getInstance();
		$settlementTotal = $em->create("SettlementTotal");
		$settlementTotal->employee = $employee;
		$settlementTotal->createDate = date("Y-m-d");
		$em->persist($settlementTotal);

		$this->_settlementTotals[] = $settlementTotal;

		return $settlementTotal;
    }

    public function printAction()
    {
    	$id = $this->_getParam("id");
    	$pdfName = "settlement_" . $id . ".pdf";
    	$em = EntityManager::getInstance();
    	$settlement = $em->find("SettlementTotal", $id);

    	header("Content-type: application/pdf");
    	header("Content-Disposition:attachment;filename=" . $pdfName);
    	$pdf = new Creator($settlement);
    	echo $pdf->render();

    	$this->getHelper("layout")->disableLayout();
    	$this->getHelper("viewRenderer")->setNoRender();
    }

    public function addbonusAction()
    {
        $id = $this->_getParam("id");
        $em = EntityManager::getInstance();

        $model = $em->create("Settlement");
        $settlementTotal = $em->find("SettlementTotal", $id);

        $dataMapper = $em->getDataMapper("Settlement");
        $dataMapper->addCondition("settlement_total_id = " . $settlementTotal->getIdentifier());
        $settlements = $dataMapper->loadAll();
        $settlementTemp = current($settlements);

        $model->application = $settlementTemp->application;
        $model->employee = $settlementTotal->employee;
        $model->createDate = date("Y-m-d");
        $model->settlementTotal = $settlementTotal;

        $form = new Settlements_BonusForm($model);
        $res = $this->getHelper("formAction")->action($form, $model, true);

        if ($res == true) {
            $this->_redirect("/settlements/edit/" . $id);
        }

        $this->view->form = $form;
        $this->view->settlementId = $id;
    }

    public function setModel(\Application\Form\Form $form, \Model\Settlement $model)
    {
        $id = $this->_getParam("id");
        $em = EntityManager::getInstance();
        $values = $form->getValue("basic");

        $model->parts = $values['parts'];
        $model->amount = $values['amount'];
        $em->persist($model);

        $settlementTotal = $em->find("SettlementTotal", $id);
        $settlementTotal->total += $values['amount'];
        $em->persist($settlementTotal);
    }
}

