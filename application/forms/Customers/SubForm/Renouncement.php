<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Customers_SubForm_Renouncement extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "policy_number");
		$element->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
			->addValidator(new Zend_Validate_Digits())
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer polisy")
			->setValue($this->getModel()->policyNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "policy_create_date");
		$element->setRequired()
			->addValidator("Date")
			->setLabel("Data zawarcia polisy")
			->setValue($this->getModel()->policyCreateDate);
		$this->addElement($element);

		$element = $this->createElement("text", "document_send_date");
		$element->addValidator("Date")
			->setLabel("Data wysłania dokumentu")
			->setValue($this->getModel()->documentSendDate);
		$this->addElement($element);
	}
}