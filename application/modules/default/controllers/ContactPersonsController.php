<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class ContactPersonsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("ContactPerson");
    }

    public function addAction()
    {
        $model = EntityManager::getInstance()->create("ContactPerson");
        $form = new ContactPersons_Form($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\ContactPerson $model)
    {
    	$values = $form->getValue("basic");
		$model->firstname = $values['firstname'];
		$model->lastname = $values['lastname'];
		$model->street = $values['street'];
		$model->city = $values['city'];
		$model->postcode = $values['postcode'];
		$model->state = EntityManager::getInstance()->find("State", $values['state']);
		$model->phoneNumber = $values['phone_number'];
		$model->email = $values['email'];
		$model->position = $values['position'];
		$model->active = $values['active'];
    }

    public function editAction()
    {
        $model = EntityManager::getInstance()->find("ContactPerson", $this->_getParam("id"));
        $form = new ContactPersons_Form($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

	public function deleteAction()
	{
		$model = EntityManager::getInstance()->find("ContactPerson", $this->_getParam("id"));
		EntityManager::getInstance()->delete($model);
		$this->_redirect("/contact-persons");
	}
}





