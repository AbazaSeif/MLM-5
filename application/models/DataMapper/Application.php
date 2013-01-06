<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use Application\Model\Collection\Collection;

use Application\Entity\EntityManager,
	Application\Model\Collection\VirtualCollection;

class Application extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Applications";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$application = new \Model\Application();
		$application->status = new \Model\ApplicationStatus();
		$application->customer = new \Model\Customer();
		$application->employee = new \Model\Employee();
		$application->seller = new \Model\Employee();
		$application->partner = new \Model\Partner();
		$application->product = new \Model\Product();
		$application->premiumType = new \Model\PremiumType();
		$application->settlementType = new \Model\SettlementType();
		$application->currency = new \Model\Currency();
		$application->documents = new \Application\Model\Collection\Collection();
		$application->shipments = new Collection();
		$application->percents = new Collection();
		$application->applicationSettlement = new \Model\ApplicationSettlement();

		$collection = new Collection();
		$collection->push(new \Model\Policy());
		$application->policy = $collection;

		return $application;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$application = new \Model\Application();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($application, $row);
		$application->status = $em->find("ApplicationStatus", $row['application_status_id']);
		$application->customer = $em->find("Customer", $row['customer_id']);
		$application->employee = $em->find("Employee", $row['employee_id']);

		if (empty($row['seller_id'])) {
			$application->seller = $em->create("Employee");
		} else {
			$application->seller = $em->find("Employee", $row['seller_id']);
		}

		$application->partner = $em->find("Partner", $row['partner_id']);
		$application->product = $em->find("Product", $row['product_id']);

		if (empty($row['premium_type_id'])) {
			$application->premiumType = $em->create("PremiumType");
		} else {
			$application->premiumType = $em->find("PremiumType", $row['premium_type_id']);
		}

		$application->settlementType = $em->find("SettlementType", $row['settlement_type_id']);
		$application->currency = $em->find("Currency", $row['currency_id']);
		$application->documents = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Document");
			return $dataMapper->findManyToManyRowset(
				$row,
				"\DbTable\Documents", "\DbTable\ApplicationDocuments");
		});
		$application->shipments = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Shipment");
			return $dataMapper->findManyToManyRowset($row, "DbTable\Shipments", "DbTable\ApplicationShipments");
		});
		$application->percents = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("ApplicationPercent");
			return $dataMapper->findDependentRowset($row, "Application");
		});
		$application->policy = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("Policy");
			return $dataMapper->findDependentRowset($row, "Application");
		});
		$application->applicationSettlement =  new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("ApplicationSettlement");
			return $dataMapper->findDependentRowset($row, "Application");
		});

		return $application;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"inner_number" => $model->innerNumber,
			"outer_number" => $model->outerNumber,
			"description" => $model->description,
			"application_status_id" => $model->status->getIdentifier(),
			"customer_id" => $model->customer->getIdentifier(),
			"employee_id" => $model->employee->getIdentifier(),
			"partner_id" => $model->partner->getIdentifier(),
			"product_id" => $model->product->getIdentifier(),
			"insurance_sum" => $model->insuranceSum,
			"premium" => $model->premium,
			"amount" => $model->amount,
			"alert" => $model->alert,
			"settlement_type_id" => $model->settlementType->getIdentifier(),
			"currency_id" => $model->currency->getIdentifier(),
			"currency_rate" => $model->currencyRate,
			"create_date" => $model->createDate,
			"investment_target" => $model->investmentTarget,
			"conclusion_date_start" => $model->conclusionDateStart,
			"conclusion_date_end" => $model->conclusionDateEnd,
			"margin" => $model->margin,
			"cost_of_repayment" => $model->costOfRepayment,
			"settled" => $model->settled
		);

		if ($model->premiumType) {
			$data['premium_type_id'] = $model->premiumType->getIdentifier();
		}

		if ($model->seller) {
			$data['seller_id'] = $model->seller->getIdentifier();
		}

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"inner_number" => $model->innerNumber,
			"outer_number" => $model->outerNumber,
			"description" => $model->description,
			"application_status_id" => $model->status->getIdentifier(),
			"customer_id" => $model->customer->getIdentifier(),
			"employee_id" => $model->employee->getIdentifier(),
			"partner_id" => $model->partner->getIdentifier(),
			"product_id" => $model->product->getIdentifier(),
			"insurance_sum" => $model->insuranceSum,
			"premium" => $model->premium,
			"amount" => $model->amount,
			"alert" => $model->alert,
			"settlement_type_id" => $model->settlementType->getIdentifier(),
			"currency_id" => $model->currency->getIdentifier(),
			"currency_rate" => $model->currencyRate,
			"create_date" => $model->createDate,
			"investment_target" => $model->investmentTarget,
			"conclusion_date_start" => $model->conclusionDateStart,
			"conclusion_date_end" => $model->conclusionDateEnd,
			"margin" => $model->margin,
			"cost_of_repayment" => $model->costOfRepayment,
			"settled" => $model->settled
		);

		if ($model->premiumType) {
			$data['premium_type_id'] = $model->premiumType->getIdentifier();
		}

		if ($model->seller) {
			$data['seller_id'] = $model->seller->getIdentifier();
		}

		$this->getDbTable()->update($data, "application_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("application_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->checkPrivileges($where);
		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->checkPrivileges($where);
		return parent::loadAll($offset, $count, $where);
	}
}