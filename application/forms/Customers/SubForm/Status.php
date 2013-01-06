<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

/**
 * Customer Status subform
 *
 * @method CustomerStatus getModel() getModel()
 */
class Customers_SubForm_Status extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alnum(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_Db_NoRecordExists(array(
				"table" 	=> "customer_statuses",
				"field" 	=> "name",
				"exclude" => array(
					"field" => "customer_status_id",
					"value" => $this->getModel()->getIdentifier()
				)
			)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_Alnum(array("allowWhiteSpace" => true)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->addValidator(new Zend_Validate_Int())
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}