<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Employees_AddressForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Employees_SubForm_Address($this->getModel());
		$basic->setLegend("Adres pracownika");
		$this->addSubForm($basic, "employee-address");

		$element = $this->createElement("hidden", "parent");
		$this->addElement($element);

	}
}