<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Agreements_SubForm_Type extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addValidator(new Zend_Validate_Db_NoRecordExists(array(
				"table" 	=> "agreement_types",
				"field"	=> "name",
				"exclude" => array(
					"field" => "agreement_type_id",
					"value" => $this->getModel()->getIdentifier()
				)
			)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "tax");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Odlicz podatek")
			->setChecked($this->getModel()->tax);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}