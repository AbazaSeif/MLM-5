<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class PartnersController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("Partner");
        $this->view->filter = new Filter_Form_Partners();
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->create("Partner");
    	$form = new Partners_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Partner $model)
    {
    	$em = EntityManager::getInstance();

    	$values = $form->getValue("basic");
    	$model->name = $values['name'];
    	$model->description = $values['description'];;
    	$model->contactPerson = $em->find("ContactPerson", $values['contact_person']);
    	$model->active = $values['active'];
    }

	public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("Partner", $this->_getParam("id"));
    	$form = new Partners_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Partner", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/partners");
	}


}



