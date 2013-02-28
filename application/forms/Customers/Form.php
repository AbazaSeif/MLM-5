<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Customers_Form extends \Application\Form\Form
{
	public function init()
	{
		$this->setEnctype("application/x-www-form-urlencoded");

		$personal = new Customers_SubForm_Basic($this->getModel());
		$personal->setLegend("Dane osobowe");
		$this->addSubForm($personal, "basic");

		$additional = new Customers_SubForm_AdditionalBasic($this->getModel());
		$additional->setLegend("Dodatkowe dane");
		$this->addSubForm($additional, "additional");

		$this->addTab("address-list", "Lista adresów", "customers/partials/address-list.phtml");
		$this->addTab("document-list", "Lista dokumentów", "customers/partials/document-list.phtml");
		$this->addTab("product-old-list", "Stare produkty", "customers/partials/product-old-list.phtml");
		$this->addTab("product-list", "Posiadane produkty", "customers/partials/product-list.phtml");
		$this->addTab("credit-old-list", "Stare kredyty", "customers/partials/credit-old-list.phtml");
		$this->addTab("history-list", "Historia", "customers/partials/history-list.phtml");
		$this->addTab("renouncement-list", "Odstąpienia", "customers/partials/renouncement-list.phtml");
	}
}