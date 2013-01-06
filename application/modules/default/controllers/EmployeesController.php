<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class EmployeesController extends Zend_Controller_Action
{
    public function indexAction()
    {
		$this->getHelper("paginator")->paginate("Employee", "employee_id > 1");
		$this->view->filter = new Filter_Form_Employees();
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
		$model = $em->create("Employee");
		$form = new Employees_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Employee $model)
    {
		$em = EntityManager::getInstance();

		$values = $form->getValue("login-form");
		$model->login = $values['login'];
		$model->password = $values['password'];

		if (!empty($values['recruit_id'])) {
			$recruit = $em->find("Recruit", $values['recruit_id']);
			$em->delete($recruit);
		}

		$values = $form->getValue("basic");
		$model->firstname = $values['firstname'];
		$model->lastname = $values['lastname'];
		$model->description = $values['description'];

		$model->parentEmployee = $em->find("Employee", $values['parent_employee']);
		$model->email = $values['email'];
		$model->phoneNumber = $values['phone_number'];
		$model->cellPhoneNumber = $values['cell_phone_number'];
		$model->position = $em->find("EmployeePosition", $values['employee_position']);
		$model->group = $em->find("EmployeeGroup", $values['employee_group']);
		$model->recommendingPerson = $values['recommending_person'];
		$model->active = $values['active'];

		$values = $form->getValue("agreement");
		$model->agreementType = $em->find("AgreementType", $values['agreement_type']);
		$model->agreementNumber = $values['agreement_number'];
		$model->agreementStartDate = $values['agreement_start_date'];
		$model->agreementEndDate = $values['agreement_end_date'];
		$model->companyName = $values['company_name'];
		$model->studentCardExpirationDate = $values['student_card_expiration_date'];
		$model->birthDate = $values['birth_date'];
		$model->birthCity = $values['birth_city'];
		$model->motherName = $values['mother_name'];
		$model->fatherName = $values['father_name'];
		$model->identityCard = $values['identity_card'];
		$model->pesel = $values['pesel'];
		$model->nip = $values['nip'];
		$model->regon = $values['regon'];
		$model->bankName = $values['bank_name'];
		$model->bankAccount = $values['bank_account'];

		$accessValues = $form->getValue("access");

		if (isset($accessValues) && is_array($accessValues)) {
			$model->access = implode("", $accessValues);
		}
    }

    public function editAction()
    {
        $em = EntityManager::getInstance();
		$model = $em->find("Employee", $this->_getParam("id"));
		$form = new Employees_Form($model);
		$this->getHelper("formAction")->action($form, $model);
		$this->view->form = $form;
		$this->view->id = $this->_getParam("id");
    }

	public function deleteAction()
	{
		$em = EntityManager::getInstance();
		$model = $em->find("Employee", $this->_getParam("id"));
		$em->delete($model);
		$this->_redirect("/employees");
	}
}



