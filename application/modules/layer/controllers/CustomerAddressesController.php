<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Layer_CustomerAddressesController extends Zend_Controller_Action
{
    public function addAction()
    {
    	$em = EntityManager::getInstance();
        $model = $em->create("CustomerAddress");
		$form = new Customers_AddressForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Zend_Form $form, \Model\CustomerAddress $model)
    {
    	$em = EntityManager::getInstance();
		$values = $form->getValue("basic");
		$model->city = $values['city'];
		$model->postcode = $values['postcode'];
		$model->state = $em->find("State", $values['state']);
		$model->street = $values['street'];
		$model->addressType = $values['address_type'];
		$model->houseNumber = $values['house_number'];
		$model->flatNumber = $values['flat_number'];

		$model->customer = $em->find("Customer", $form->getValue("parent"));
    }

    public function editAction()
    {
        $em = EntityManager::getInstance();
        $model = $em->find("CustomerAddress", $this->_getParam("id"));
		$form = new Customers_AddressForm($model);
		$this->getHelper("FormAction")->simpleAction($form, $model);
        $this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerAddress", $this->_getParam("id"));
		$em->delete($model);
		$this->getHelper("formAction")->simpleEndAction();
	}
}

