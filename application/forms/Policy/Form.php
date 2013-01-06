<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Policy_Form extends \Application\Form\Form
{
	public function init()
	{
		$basic  = new Policy_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane podstawowe");
		$this->addSubForm($basic, "basic");

		$shippment = new Shipments_SubForm_Basic($this->getModel()->shipment);
		$shippment->setLegend("Dostawa");
		$this->addSubForm($shippment, "shipment");

		$element = $this->createElement("submit", "submit");
		$element->setLabel("Zapisz")
		->setIgnore(true);
		$this->addElement($element);
	}
}