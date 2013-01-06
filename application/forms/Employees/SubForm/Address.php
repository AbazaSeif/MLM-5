<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Employees_SubForm_Address extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "street");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Ulica")
			->setValue($this->getModel()->street);
		$this->addElement($element);

		$element = $this->createElement("text", "house_number");
		$element->setRequired()
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nr domu")
			->setValue($this->getModel()->houseNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "flat_number");
		$element->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nr mieszkania")
			->setValue($this->getModel()->flatNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "city");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Miasto")
			->setValue($this->getModel()->city);
		$this->addElement($element);

		$element = $this->createElement("text", "postcode");
		$element->setRequired()
			->addValidator(new Zend_Validate_PostCode(Zend_Registry::get(\Application\Registry\Registry::LOCALE)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Kod pocztowy")
			->setValue($this->getModel()->postcode);
		$this->addElement($element);

		$states = $em->findAll("State");
		$element = $this->createElement("select", "state");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Województwo")
			->setValue($this->getModel()->state->getIdentifier())
			->setMultiOptions($this->getMultiOptions($states, "name"));
		$this->addElement($element);

		$element = $this->createElement("select", "address_type");
		$element->setRequired()
			->setMultiOptions(array(
				\Model\EmployeeAddress::BILLING_ADDRESS 		=> "do płatności",
				\Model\EmployeeAddress::SHIPPING_ADDRESS 	=> "do wysyłki"
			))
			->setLabel("Typ adresu")
			->setValue($this->getModel()->type);
		$this->addElement($element);
	}
}