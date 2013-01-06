<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class InstructionsController extends \Zend_Controller_Action
{
	public function indexAction()
	{
		$this->getHelper("paginator")->paginate("Instruction");
	}

	public function addAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->create("Instruction");
		$form = new Instructions_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\Instruction $model)
	{
		$values = $form->getValue("basic");
		$model->name = $values['name'];
		$model->active = $values['active'];
	}

	public function editAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("Instruction", $this->_getParam("id"));
		$form = new Instructions_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em =  EntityManager::getInstance();
		$model = $em->find("Instruction", $this->_getParam("id"));
		$em->delete($model);
	}
}