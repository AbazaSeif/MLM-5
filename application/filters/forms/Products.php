<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Form_Products extends \Application\Filter\Form
{
	public function init()
	{
		$element = $this->createElement("text", "name")
			->setLabel("Nazwa");
		$this->addElement($element);

		$partners = $this->getEm()->findAllActive("Partner");
		$element = $this->createElement("select", "partner")
			->setLabel("Partner")
			->setMultiOptions(
				$this->getMultiOptions($partners, "name")
			);
		$this->addElement($element);

		$types = $this->getEm()->findAllActive("ProductType");
		$element = $this->createElement("select", "type")
			->setLabel("Typ")
			->setMultiOptions(
				$this->getMultiOptions($types, "name")
			);
		$this->addElement($element);

		$currency = $this->getEm()->findAllActive("Currency");
		$element = $this->createElement("select", "currency")
			->setLabel("Waluta")
			->setMultiOptions(
				$this->getMultiOptions($currency, "name")
			);
		$this->addElement($element);

		$contactPersons = $this->getEm()->findAllActive("ContactPerson");
		$element = $this->createElement("select", "contact")
			->setLabel("Kontakt")
			->setMultiOptions(
				$this->getMultiOptions($contactPersons, array("lastname", "firstname"))
			);
		$this->addElement($element);

		$settlementTypes = $this->getEm()->findAllActive("SettlementType");
		$element = $this->createElement("select", "settlement")
			->setLabel("Rozliczenie")
			->setMultiOptions(
				$this->getMultiOptions($settlementTypes, "name")
			);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active")
			->setLabel("Aktywność");
		$this->addElement($element);
	}
}