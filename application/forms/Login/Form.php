<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Login_Form extends Zend_Form
{
	public function init()
	{
		$element = $this->createElement("text", "login");
		$element->setRequired();
		$element->addFilter(new Zend_Filter_StringTrim());
		$this->addElement($element);

		$element = $this->createElement("password", "password");
		$element->setRequired();
		$element->addFilter(new Zend_Filter_StringTrim());
		$this->addElement($element);
	}

}