<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_ApplicationShipmentsController extends Zend_Controller_Action
{
	public function addAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->create("Shipment");
		$form = new Applications_ShipmentForm($model);
		if ($this->getHelper("FormAction")->simpleAction($form, $model, true)) {
			$applicationShipment = $em->create("ApplicationShipment");
			$applicationShipment->application =  $em->find("Application", $form->getValue("parent"));
			$applicationShipment->shipment = $model;
			$em->persist($applicationShipment);
			$this->getHelper("formAction")->simpleEndAction();
		}
		$this->view->form = $form;
	}

	public function setModel(\Zend_Form $form, \Model\Shipment $model)
	{
		$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->createDate = date("Y-m-d H:i:s");
		$model->street = $values['street'];
		$model->email = $values['email'];
		$model->city = $values['city'];
		$model->postcode = $values['postcode'];
		$model->state = $em->find("State", $values['state']);
		$model->type = $em->find("ShipmentType", $values['type']);
		$model->phoneNumber = $values['phone_number'];
	}

	public function editAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Shipment", $this->_getParam("id"));
		$form = new Applications_ShipmentForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
		$this->view->form = $form;
	}

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Shipment", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}