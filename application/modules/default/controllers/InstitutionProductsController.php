<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class InstitutionProductsController extends \Zend_Controller_Action
{
	public function indexAction()
	{
		$this->getHelper("paginator")->paginate("InstitutionProduct");
	}

	public function addAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->create("InstitutionProduct");
		$form = new Institutions_ProductForm($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\InstitutionProduct $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->name = $values['name'];
		$model->active = $values['active'];
		$model->institution = $em->find("Institution", $values['institution']);
	}

	public function editAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("InstitutionProduct", $this->_getParam("id"));
		$form = new Institutions_ProductForm($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("InstitutionProduct", $this->_getParam("id"));
		$em->delete($model);
	}
}