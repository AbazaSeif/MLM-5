<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_CustomerProductsController extends Zend_Controller_Action
{

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

	public function editAction()
	{
	    $em = EntityManager::getInstance();

	    $productId  = $this->_getParam("id");
	    $customerId = $this->_getParam("parent");

	    $dataMapper = $em->getDataMapper("Application");
	    $dataMapper->addCondition("product_id = " . $productId);
	    $dataMapper->addCondition("customer_id = " . $customerId);
	    $identifiers = $dataMapper->loadAllIdentifiers();


        $applicationId = $identifiers->current()->application_id;

		$model = $em->find("Application", $applicationId);
		$form = new Applications_SimpleForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}
}

