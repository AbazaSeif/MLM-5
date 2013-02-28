<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_CustomerHistoryController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("CustomerHistory");
		$form = new Customers_HistoryForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\CustomerHistory $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->date = $values['date'];
		$model->info = $values['info'];

		$model->customer = $em->find("Customer", $form->getValue("parent"));
	}

	public function editAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerHistory", $this->_getParam("id"));
		$form = new Customers_HistoryForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerHistory", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

