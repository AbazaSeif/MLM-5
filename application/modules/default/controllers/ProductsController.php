<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class ProductsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("Product");
        $this->view->filter = new Filter_Form_Products();
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
		$model = $em->create("Product");
		$form = new Products_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Product $model)
    {
    	$em = EntityManager::getInstance();

		$values = $form->getValue("basic");
		$model->name = $values['name'];
		$model->description = $values['description'];
		$model->partner = $em->find("Partner", $values['partner']);
		$model->currency = $em->find("Currency", $values['currency']);
		$model->contactPerson = $em->find("ContactPerson", $values['contact_person']);
		$model->type = $em->find("ProductType", $values['product_type']);
		$model->active = $values['active'];

		$values = $form->getValue("settlement");
		$model->settlementType = $em->find("SettlementType", $values['settlement_type']);
		$model->sellerPercent = $values['seller_percent'];
		$model->percents = new \Application\Model\Collection\Collection();

		unset($values['settlement_type']);
		unset($values['seller_percent']);

		foreach ($values as $key =>  $productSettlementPercent) {
			$percent = $em->create("ProductSettlementPercent");
			$percent->product = $model;
			$employeePositionId = str_replace("employee_position_" , "", $key);
			$percent->employeePosition = $em->find("EmployeePosition", $employeePositionId);
			$percent->value = $productSettlementPercent;
			$model->percents->push($percent);
		}
    }

    public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("Product", $this->_getParam("id"));
    	$form = new Products_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Product", $this->_getParam("id"));
		EntityManager::getInstance()->delete($model);
		$this->_redirect("/products");
	}
}