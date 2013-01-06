<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

/**
 * Employee Login subform
 * @method Employee getModel() getModel()
 */
class Employees_SubForm_Login extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("hidden", "recruit_id");
		$this->addElement($element);

		$element = $this->createElement("text", "login");
		$element->setRequired()
			->addValidator(new Zend_Validate_Db_NoRecordExists(array(
				"table" => "employees",
				"field" => "login",
				"exclude" => array(
					"field" => "employee_id",
					"value" => $this->getModel()->getIdentifier()
				)
			)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Login")
			->setValue($this->getModel()->login)
			->setAttrib("autocomplete", "off");
		$this->addElement($element);

		$element = $this->createElement("password", "password");
		$element->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Hasło")
			->setAttrib("autocomplete", "off");

		if ($this->getModel()->getIdentifier() == 0) {
			$element->setRequired();
		}

		$this->addElement($element);
	}
}