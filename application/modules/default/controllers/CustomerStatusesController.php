<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class CustomerStatusesController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("CustomerStatus");
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
        $model = $em->create("CustomerStatus");
        $form = new Customers_StatusForm($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\CustomerStatus $model)
    {
    	$values = $form->getValue("status");
    	$model->name = $values["name"];
    	$model->active = $values["active"];
    }

    public function editAction()
    {
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerStatus", $this->_getParam("id"));
		$form = new Customers_StatusForm($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("CustomerStatus", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/customer-statuses");
	}
}