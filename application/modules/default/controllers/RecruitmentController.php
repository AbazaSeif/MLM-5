<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class RecruitmentController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$this->getHelper("paginator")->paginate("Recruit");
		$this->view->filter = new Filter_Form_Recruitment();
	}

	public function addAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->create("Recruit");
        $form = new Recruitment_Form($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Recruit $model)
    {
    	$em = EntityManager::getInstance();

		$values = $form->getValue("basic");
		$model->firstname = $values['firstname'];
		$model->lastname = $values['lastname'];
		$model->description = $values['description'];
		$model->parentEmployee = $em->find("Employee", $values['parent_employee']);
		$model->email = $values['email'];
		$model->phoneNumber = $values['phone_number'];
		$model->position = $em->find("EmployeePosition", $values['employee_position']);
		$model->recommendingPerson = $values['recommending_person'];
		$model->active = $values['active'];
    }

    public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("Recruit", $this->_getParam("id"));
    	$form = new Recruitment_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Recruit", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/recruitment");
	}
}





