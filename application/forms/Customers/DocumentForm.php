<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Customers_DocumentForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Customers_SubForm_Document($this->getModel());
		$basic->setEnctype("multipart/form-data")
			->setLegend("Dokument klienta");
		$this->addSubForm($basic, "basic");

		$element = $this->createElement("hidden", "parent");
		$this->addElement($element);
	}
}