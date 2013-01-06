<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use DataMapper\Application;

use \Application\Entity\EntityManager;

class Layer_ApplicationDocumentsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("Document");
		$form = new Applications_DocumentForm($model);
		if ($this->getHelper("FormAction")->simpleAction($form, $model, true)) {
			$applicationDocument = new \Model\ApplicationDocument();
			$applicationDocument->customer = $em->find("Customer", $form->getValue("parent"));
			$applicationDocument->document = $model;
			$em->persist($applicationDocument);
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
		$uniqName = md5(time()) . "." . pathinfo($oldFilename, PATHINFO_EXTENSION);
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

