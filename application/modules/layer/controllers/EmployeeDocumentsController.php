<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_EmployeeDocumentsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("Document");
		$form = new Employees_DocumentForm($model);
		if ($this->getHelper("FormAction")->simpleAction($form, $model, true)) {
			$employeeDocument = new \Model\EmployeeDocument();
			$employeeDocument->employee = $em->find("Employee", $form->getValue("parent"));
			$employeeDocument->document = $model;
			$em->persist($employeeDocument);
			$this->getHelper("formAction")->simpleEndAction();
		}
		$this->view->form = $form;
	}

	public function setModel(\Zend_Form $form, \Model\Document $model)
	{
		$em = \Application\Entity\EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->createDate = date("Y-m-d H:i:s");

		$oldFilename = APPLICATION_PATH . "/../tmp/" . $values['document'];
		$uniqName = uniqid() . "." . pathinfo($oldFilename, PATHINFO_EXTENSION);
		$newFilename = APPLICATION_PATH . "/../public/documents/" . $uniqName;
		rename($oldFilename, $newFilename);

		$model->path = $uniqName;
		$model->employee = $em->find("Employee", Zend_Auth::getInstance()->getIdentity()->employee_id);
		$model->name = $values['name'];
		$model->type = $values['type'];
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Document", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

