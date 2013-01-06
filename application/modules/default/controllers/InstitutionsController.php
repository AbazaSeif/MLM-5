<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class InstitutionsController extends \Zend_Controller_Action
{
	public function indexAction()
	{
		$this->getHelper("paginator")->paginate("Institution");
	}

	public function addAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->create("Institution");
		$form = new Institutions_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\Institution $model)
	{
		$values = $form->getValue("basic");
		$model->name = $values['name'];
		$model->active = $values['active'];
	}

	public function editAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("Institution", $this->_getParam("id"));
		$form = new Institutions_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("Institution", $this->_getParam("id"));
		$em->delete($model);
	}
}