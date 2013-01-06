<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class ApplicationsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("Application");
        $this->view->filter = new Filter_Form_Applications();
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
        $model = $em->create("Application");
        $form = new Applications_Form($model);
        if($this->getHelper("formAction")->action($form, $model, true)) {
        	$policy = $em->create("Policy");
        	$this->setPolicy($form, $policy, $model);
        	$em->persist($policy);
        	$this->getHelper("formAction")->endAction($model);
        }
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Application $model)
    {
    	$em = EntityManager::getInstance();

		$values = $form->getValue("basic");
		$model->innerNumber = $values['inner_number'];
		$model->outerNumber = $values['outer_number'];
		$model->description = $values['description'];
		$model->status = $em->find("ApplicationStatus", $values['status']);
		$model->customer = $em->find("Customer", $values['customer']);
		$model->employee = $em->find("Employee", $values['employee']);
		$model->seller = $em->find("Employee", $values['seller']);
		$model->partner = $em->find("Partner", $values['partner']);
		$model->product = $em->find("Product", $values['product']);

		$values = $form->getValue("settlement");
		$model->insuranceSum = $values['insurance_sum'];
		$model->premiumType = $em->find("PremiumType", $values['premium_type']);
		$model->premium = $values['premium'];
		$model->amount = $values['amount'];
		$model->settlementType = $em->find("SettlementType", $values['settlement_type']);
		$model->currency = $em->find("Currency", $values['currency']);
		$model->currencyRate = $values['currency_rate'];
		$model->investmentTarget = $values['investment_target'];
		$model->conclusionDateStart = $values['conclusion_date_start'];
		$model->conclusionDateEnd = $values['conclusion_date_end'];
		$model->margin = $values['margin'];
		$model->costOfRepayment = $values['cost_of_repayment'];

		$model->settled = 0;
    }

    public function setPolicy(\Zend_Form $form, \Model\Policy $policy, \Model\Application $application)
    {
    	$em = EntityManager::getInstance();
    	$values = $form->getValue("policy");
    	$policy->application = $application;
    	$policy->outerNumber = $values['policy_outer_number'];
    	$policy->createDate = $values['policy_create_date'];
    	$policy->endDate = $values['policy_end_date'];
    	$policy->popPlace = $values['policy_pop_place'];
    	$policy->deliveryDate = $values['policy_delivery_date'];
    	$policy->popReturnDate = $values['policy_pop_return_date'];
    }

    public function editAction()
    {
        $em = EntityManager::getInstance();
        $model = $em->find("Application", $this->_getParam("id"));
        $form = new Applications_Form($model);
	     if($this->getHelper("formAction")->action($form, $model, true)) {
	     	$policy = $model->policy->current();
        	$this->setPolicy($form, $policy, $model);
        	$em->persist($policy);
        	$this->getHelper("formAction")->endAction($model);
        }
        $this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Application", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/applications");
	}

	public function printAction()
	{
		$this->_redirect("/applications");
	}
}





