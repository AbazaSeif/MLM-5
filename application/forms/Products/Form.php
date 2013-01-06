<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Products_Form extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Products_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane podstawowe");
		$this->addSubForm($basic, "basic");

		$settlement = new Products_SubForm_Settlement($this->getModel());
		$settlement->setLegend("Rozliczenie");
		$this->addSubForm($settlement, "settlement");

		$this->addTab("customer-list", "Lista klientów", "products/partials/customer-list.phtml");
	}
}