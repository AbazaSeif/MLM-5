<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_CustomerOldProductsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("CustomerOldProduct");
		$form = new Customers_OldProductForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\CustomerOldProduct $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->institution = $em->find("Institution", $values['institution']);
		$model->institutionProduct = $em->find("InstitutionProduct", $values['institution_product']);
		$model->instruction = $em->find("Instruction", $values['instruction']);
		$model->insuranceSum = $values['insurance_sum'];
		$model->insuranceSumNnw = $values['insurance_sum_nnw'];
		$model->insuranceSumNkw = $values['insurance_sum_nkw'];
		$model->conclusionDateStart = $values['conclusion_date_start'];
		$model->conclusionDateEnd = $values['conclusion_date_end'];
		$model->fee = $values['fee'];
		$model->premiumType = $em->find("PremiumType", $values['premium_type']);
		$model->contribution = $values['contribution'];
		$model->amount = $values['amount'];
		$model->productCreateDate = $values['create_date'];
		$model->policyNumber = $values['policy_number'];
		$model->description = $values['description'];

		$model->customer = $em->find("Customer", $form->getValue("parent"));
	}

	public function editAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerOldProduct", $this->_getParam("id"));
		$form = new Customers_OldProductForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerOldProduct", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

