<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class EmployeePositionsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("EmployeePosition");
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
        $model = $em->create("EmployeePosition");
        $form = new Employees_PositionForm($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\EmployeePosition $model)
    {
		$values = $form->getValue("basic");
		$model->name = $values['name'];
		$model->active = $values['active'];
    }

    public function editAction()
    {
        $em = EntityManager::getInstance();
        $model = $em->find("EmployeePosition", $this->_getParam("id"));
        $form = new Employees_PositionForm($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("EmployeePosition", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/employee-positions");
	}
}





