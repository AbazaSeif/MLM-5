<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Form_Applications extends \Application\Filter\Form
{
	public function init()
	{
		$element = $this->createElement("text", "number")
			->setLabel("Numer");
		$this->addElement($element);

		$customers = $this->getEm()->findAllActive("Customer");
		$element = $this->createElement("select", "customer")
			->setLabel("Klient")
			->setMultiOptions(
				$this->getMultiOptions($customers, array("lastname", "firstname"))
			);
		$this->addElement($element);

		$employees = $this->getEm()->findAllActive("Employee");
		$element = $this->createElement("select", "employee")
			->setLabel("Pracownik")
			->setMultiOptions(
				$this->getMultiOptions($employees, array("lastname", "firstname"))
			);
		$this->addElement($element);

		$products = $this->getEm()->findAllActive("Product");
		$element = $this->createElement("select", "product")
			->setLabel("Produkt")
			->setMultiOptions(
				$this->getMultiOptions($products, "name")
			);
		$this->addElement($element);

		$settlementTypes = $this->getEm()->findAllActive("SettlementType");
		$element = $this->createElement("select", "settlement")
			->setLabel("Rozliczenie")
			->setMultiOptions(
				$this->getMultiOptions($settlementTypes, "name")
			);
		$this->addElement($element);

		$currency = $this->getEm()->findAllActive("Currency");
		$element = $this->createElement("select", "currency")
			->setLabel("Waluta")
			->setMultiOptions(
				$this->getMultiOptions($currency, "name")
			);
		$this->addElement($element);

		$statuses = $this->getEm()->findAllActive("ApplicationStatus");
		$element = $this->createElement("select", "status")
			->setLabel("Status")
			->setMultiOptions(
				$this->getMultiOptions($statuses, "name")
			);
		$this->addElement($element);

		$element = $this->createElement("text", "date_from")
			->setLabel("Data")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "date_to")
			->setLabel("-")
			->setAttrib("class", "small");
		$this->addElement($element);
	}
}