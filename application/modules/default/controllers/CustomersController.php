<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class CustomersController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("Customer");
        $this->view->filter = new Filter_Form_Customers();
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->create("Customer");
        $form = new Customers_Form($model);
        $this->getHelper("formAction")->action($form, $model);
        $this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Customer $model)
    {
    	$em = EntityManager::getInstance();

		$values = $form->getValue("basic");
		$model->firstname = $values['firstname'];
		$model->lastname = $values['lastname'];
		$model->email = $values['email'];
		$model->phoneNumber = $values['phone_number'];
		$model->cellPhoneNumber = $values['cell_phone_number'];
		$model->group = $em->find("CustomerGroup", $values['customer_group']);
		$model->male = $values['male'];
		$model->employee = $em->find("Employee", $values['employee']);
		$model->status = $em->find("CustomerStatus", $values['customer_status']);
		$model->recommendingPerson = $values['recommending_person'];
		$model->dateOfLastAnalysis = $values['date_of_last_analysis'];
		$model->numberOfLastAnalysis = $values['number_of_last_analysis'];
		$model->active = $values['active'];

		$values = $form->getValue("additional");
		$model->birthDate = $values['birth_date'];
		$model->birthCity = $values['birth_city'];
		$model->identityCard = $values['identity_card'];
		$model->pesel = $values['pesel'];
		$model->nip = $values['nip'];
		$model->regon = $values['regon'];
    }

    public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("Customer", $this->_getParam("id"));
    	$form = new Customers_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Customer", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/customers");
	}
}





