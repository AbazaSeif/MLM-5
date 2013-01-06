<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Employees_DocumentForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Employees_SubForm_Document($this->getModel());
		$basic->setEnctype("multipart/form-data")
			->setLegend("Dokument pracownika");
		$this->addSubForm($basic, "basic");

		$element = $this->createElement("hidden", "parent");
		$this->addElement($element);
	}
}