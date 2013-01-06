<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * Employee Basic subform
 * @method Employee getModel() getModel()
 */
class Employees_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "firstname");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alpha(array("allowWhitespace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Imię")
			->setValue($this->getModel()->firstname);
		$this->addElement($element);

		$element = $this->createElement("text", "lastname");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alpha(array("allowWhitespace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwisko")
			->setValue($this->getModel()->lastname);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$employees = $em->findAllActive("Employee", "employee_id != " . $this->getModel()->getIdentifier());
		$element = $this->createElement("select", "parent_employee");
		$element->addValidator(new Zend_Validate_Int())
			->setLabel("Bezpośredni przełożony")
			->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")))
			->setValue($this->getModel()->parentEmployee->getIdentifier());

		if ($this->getModel()->parentEmployee->getIdentifier() == 1) {
			$element->setAttrib('disabled', 'disabled');
		} else {
			$element->setRequired()->addFilter(new Zend_Filter_Null());
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
		$element->addFilter(new Zend_Filter_StringTrim())
			->setlabel('Numer tel. stacjonarnego')
			->setValue($this->getModel()->phoneNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "cell_phone_number");
		$element->addFilter(new Zend_Filter_StringTrim())
			->setlabel('Numer tel. komórkowego')
			->setValue($this->getModel()->cellPhoneNumber);
		$this->addElement($element);

		$positions = $em->findAllActive("EmployeePosition");
		$element = $this->createElement("select", "employee_position");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Stanowisko")
			->setValue($this->getModel()->position->getIdentifier())
			->setMultiOptions($this->getMultiOptions($positions, "name"));
		$this->addElement($element);

		$groups = $em->findAllActive("EmployeeGroup");
		$element = $this->createElement("select", "employee_group");
		$element->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Grupa")
			->setValue($this->getModel()->group->getIdentifier())
			->setMultiOptions($this->getMultiOptions($groups, "name"));
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