<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * Customer Personal subform
 *
 * @method Customer getModel() getModel()
 */
class Customers_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

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

		$element = $this->createElement("text", "email");
		$element->addValidator(new Zend_Validate_EmailAddress())
			->addValidator(
				new Zend_Validate_Db_NoRecordExists(
					array(
						"table"	=> "customers",
						"field" 	=> "email",
						"exclude" => array(
							"field" => "customer_id",
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

		$element = $this->createElement("select", "male");
		$element->setRequired()
			->setMultiOptions(
				array(
					\Model\Customer::MALE 	=> "mężczyzna",
					\Model\Customer::FEMALE 	=> "kobieta"
				)
			)
			->addFilter(new Zend_Filter_Null())
			->setLabel("Płeć")
			->setValue($this->getModel()->male);
		$this->addElement($element);

		$employees = $em->findAllActive("Employee");
		$element = $this->createElement("select", "employee");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Doradca")
			->setValue($this->getModel()->employee->getIdentifier())
			->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")));
		$this->addElement($element);

		$groups = $em->findAllActive("CustomerGroup");
		$element = $this->createElement("select", "customer_group");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Grupa")
			->setValue($this->getModel()->group->getIdentifier())
			->setMultiOptions($this->getMultiOptions($groups, "name"));
		$this->addElement($element);

		$statuses = $em->findAllActive("CustomerStatus");
		$element = $this->createElement("select", "customer_status");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Status")
			->setValue($this->getModel()->status->getIdentifier())
			->setMultiOptions($this->getMultiOptions($statuses, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "recommending_person");
		$element->addValidator(new Zend_Validate_Alnum(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_Alnum(array("allow WhiteSpace" => true)))
			->setLabel("Osoba polecająca")
			->setValue($this->getModel()->recommendingPerson);
		$this->addElement($element);

		$element = $this->createElement("text", "date_of_last_analysis");
		$element->addValidator(new Zend_Validate_Date())
			->setLabel("Data ostatniej analizy")
			->setValue($this->getModel()->dateOfLastAnalysis);
		$this->addElement($element);

		$element = $this->createElement("text", "number_of_last_analysis");
		$element->addFilter("StringTrim")
			->setLabel("Numer ostatniej analizy")
			->setValue($this->getModel()->numberOfLastAnalysis);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}