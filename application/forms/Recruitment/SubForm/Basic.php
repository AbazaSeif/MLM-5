<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Recruitment_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = Entitymanager::getInstance();

		$element = $this->createElement("hidden", "recruit_id");
		$element->setValue($this->getModel()->getIdentifier());
		$this->addElement($element);

		$element = $this->createElement("text", "firstname");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alpha(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Imię")
			->setValue($this->getModel()->firstname);
		$this->addElement($element);

		$element = $this->createElement("text", "lastname");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alpha(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwisko")
			->setValue($this->getModel()->lastname);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$employees = $em->findAllActive("Employee");
		$element = $this->createElement("select", "parent_employee");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Bezpośredni przełożony")
			->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")))
			->setValue($this->getModel()->parentEmployee->getIdentifier());
		$this->addElement($element);

		$element = $this->createElement("select", "verifier_id");
		$element->addValidator(new Zend_Validate_Int())
    		->addFilter(new Zend_Filter_Null())
    		->setLabel("Sprawdzający")
    		->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")));

		if ($this->getModel()->verifier) {
		    $element->setValue($this->getModel()->verifier->getIdentifier());
		}
		$this->addElement($element);

		$element = $this->createElement("text", "email");
		$element->setRequired()
			->addValidator(new Zend_Validate_EmailAddress())
			->addValidator(
				new Zend_Validate_Db_NoRecordExists(
					array(
						"table"	=> "employees",
						"field" 	=> "email",
						"exclude" => array(
							"field" => "employee_id",
							"value" => $this->getModel()->getIdentifier()
						)
					)
				)
			)
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Email")
			->setValue($this->getModel()->email);
		$this->addElement($element);

		$element = $this->createElement("text", "phone_number");
		$element->setRequired()
			->addFilter(new Zend_Filter_StringTrim())
			->setlabel('Numer telefonu')
			->setValue($this->getModel()->phoneNumber);
		$this->addElement($element);

		$positions = $em->findAllActive('EmployeePosition');
		$element = $this->createElement("select", "employee_position");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Stanowisko")
			->setValue($this->getModel()->position->getIdentifier())
			->setMultiOptions($this->getMultiOptions($positions, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "recommending_person");
		$element->addValidator(new Zend_Validate_Alnum(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_Alnum(array("allowWhiteSpace" => true)))
			->setLabel("Osoba polecająca")
			->setValue($this->getModel()->recommendingPerson);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}