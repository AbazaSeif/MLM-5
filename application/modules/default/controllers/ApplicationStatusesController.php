<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class ApplicationStatusesController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("ApplicationStatus");
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->create("ApplicationStatus");
    	$form = new Applications_StatusForm($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\ApplicationStatus $model)
    {
    	$values = $form->getValue("basic");
    	$model->name = $values['name'];
    	$model->active = $values['active'];
    	$model->takenToSettle = $values['taken_to_settle'];
    }

    public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("ApplicationStatus", $this->_getParam("id"));
    	$form = new Applications_StatusForm($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

    public function deleteAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("ApplicationStatus", $this->_getParam("id"));
    	$em->delete($model);

    	$this->_redirect("/application-statuses");
    }
}





