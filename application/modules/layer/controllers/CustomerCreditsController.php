<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_CustomerCreditsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("CustomerCredit");
		$form = new Customers_CreditForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\CustomerCredit $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->amount = $values['amount'];
		$model->balance = $values['balance'];
		$model->balanceDate = $values['balance_date'];
		$model->bank = $values['bank'];
		$model->conclusionDateStart = $values['conclusion_date_start'];
		$model->costOfRepayment = $values['cost_of_repayment'];
		$model->currency = $em->find("Currency", $values['currency']);
		$model->currencyRate = $values['currency_rate'];
		$model->installment = $values['installment'];
		$model->periodInMonths = $values['period_in_months'];
		$model->type = $em->find("CreditType", $values["type"]);
		$model->margin = $values['margin'];
		$model->rrso = $values['rrso'];

		$model->customer = $em->find("Customer", $form->getValue("parent"));
	}

	public function editAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerCredit", $this->_getParam("id"));
		$form = new Customers_CreditForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerCredit", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

