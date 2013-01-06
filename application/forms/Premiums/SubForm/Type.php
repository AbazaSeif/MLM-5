<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

/**
 * Premium Type subform
 * @method PremiumType getModel() getModel()
 */
class Premiums_SubForm_Type extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addValidator(new Zend_Validate_Db_NoRecordExists(array(
				"table" 	=> "premium_types",
				"field"	=> "name",
				"exclude" => array(
					"field" => "premium_type_id",
					"value" => $this->getModel()->getIdentifier()
				)
			)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("select", "period_in_months");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setMultiOptions(array(range(1, 12)))
			->setValue($this->getModel()->periodInMonths);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}