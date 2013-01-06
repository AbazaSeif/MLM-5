<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Customers_SubForm_AdditionalBasic extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "birth_date");
		$element->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Data urodzenia")
			->setValue($this->getModel()->birthDate);
		$this->addElement($element);

		$element = $this->createElement("text", "birth_city");
		$element->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Miejsce urodzenia")
			->setValue($this->getModel()->birthCity);
		$this->addElement($element);

		$element = $this->createElement("text", "identity_card");
		$element->addValidator(new Zend_Validate_Alnum())
			->addValidator(new Zend_Validate_StringLength(array("max" => 10)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer dowodu os.")
			->setValue($this->getModel()->identityCard);
		$this->addElement($element);

		$element = $this->createElement("text", "pesel");
		$element->addValidator(new Zend_Validate_Digits())
			->addValidator(new Zend_Validate_StringLength(array("min" => 11,  "max" => 11)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("PESEL")
			->setValue($this->getModel()->pesel);
		$this->addElement($element);

		$element = $this->createElement("text", "nip");
		$element->addValidator(new Zend_Validate_Digits())
			->addValidator(new Zend_Validate_StringLength(array("max" => "15")))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("NIP")
			->setValue($this->getModel()->nip);
		$this->addElement($element);

		$element = $this->createElement("text", "regon");
		$element->addValidator(new Zend_Validate_Int())
			->addValidator(new Zend_Validate_StringLength(array("max" => "15")))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("REGON")
			->setValue($this->getModel()->regon);
		$this->addElement($element);
	}
}