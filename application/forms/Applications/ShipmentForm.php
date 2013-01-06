<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Applications_ShipmentForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Shipments_SubForm_Basic($this->getModel());
		$basic->setLegend("Wysyłka");
		$this->addSubForm($basic, "basic");

		$element = $this->createElement("hidden", "parent");
		$this->addElement($element);
	}
}