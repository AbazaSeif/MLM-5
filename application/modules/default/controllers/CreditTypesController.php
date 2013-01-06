<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class CreditTypesController extends \Zend_Controller_Action
{
	public function indexAction()
	{
		$this->getHelper("paginator")->paginate("CreditType");
	}

	public function addAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->create("CreditType");
		$form = new CreditTypes_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\CreditType $model)
	{
		$values = $form->getValue("basic");
		$model->name = $values['name'];
		$model->active = $values['active'];
	}

	public function editAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("CreditType", $this->_getParam("id"));
		$form = new CreditTypes_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("CreditType", $this->_getParam("id"));
		$em->delete($model);
	}
}