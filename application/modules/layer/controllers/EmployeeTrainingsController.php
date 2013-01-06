<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_EmployeeTrainingsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("EmployeeTraining");
		$form = new Employees_TrainingForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function setModel(Zend_Form $form, \Model\EmployeeTraining $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->training = $em->find("Training", $values['training']);
		$model->employee = $em->find("Employee", $form->getValue("parent"));
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("EmployeeTraining", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

