<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Policy_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "policy_outer_number");
		$element->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
			->addValidator(new Zend_Validate_Digits())
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer zewnętrzny")
			->setValue($this->getModel()->outerNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "policy_create_date");
		$element->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Data zawarcia")
			->setValue($this->getModel()->createDate);
		$this->addElement($element);

		$element = $this->createElement("text", "policy_end_date");
		$element->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Data zakończenia")
			->setValue($this->getModel()->endDate);
		$this->addElement($element);

		$element = $this->createElement("text", "policy_pop_place");
		$element->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->setLabel("Miejsce POP-a")
			->setValue($this->getModel()->popPlace);
		$this->addElement($element);

		$element = $this->createElement("text", "policy_delivery_date");
		$element->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Data dostarczenia do klienta")
			->setValue($this->getModel()->deliveryDate);
		$this->addElement($element);

		$element = $this->createElement("text", "policy_pop_return_date");
		$element->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Data zwrotu POP-a")
			->setValue($this->getModel()->popReturnDate);
		$this->addElement($element);
	}
}