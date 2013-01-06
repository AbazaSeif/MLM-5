<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class TrainingsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("Training");
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
        $model = $em->create("Training");
        $form = new Trainings_Form($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Training $model)
    {
		$values = $form->getValue("basic");
		$model->title = $values['title'];
		$model->description = $values['description'];
		$model->active = $values['active'];
    }

    public function editAction()
    {
        $em = EntityManager::getInstance();
        $model = $em->find("Training", $this->_getParam("id"));
        $form = new Trainings_Form($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Training", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/trainings");
	}
}





