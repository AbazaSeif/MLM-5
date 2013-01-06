<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Form_Customers extends \Application\Filter\Form
{
	public function init()
	{
		$element = $this->createElement("text", "name")
			->setLabel("Nazwa");
		$this->addElement($element);

		$element = $this->createElement("text", "phone")
			->setLabel("Telefon");
		$this->addElement($element);

		$element = $this->createElement("text", "email")
			->setLabel("Email");
		$this->addElement($element);

		$employees = $this->getEm()->findAllActive("Employee");
		$element = $this->createElement("select", "employee")
			->setLabel("Doradca")
			->setMultiOptions(
				$this->getMultiOptions($employees, array("lastname", "firstname"))
			);
		$this->addElement($element);

		$element = $this->createElement("text", "city")
			->setLabel("Miasto");
		$this->addElement($element);

		$groups = $this->getEm()->findAllActive("CustomerGroup");
		$element = $this->createElement("select", "group")
			->setLabel("Grupa")
			->setMultiOptions(
				$this->getMultiOptions($groups, "name")
			);
		$this->addElement($element);

		$instructions = $this->getEm()->findAllActive("Instruction");
		$element = $this->createElement("select", "instruction")
			->setLabel("Instrument")
			->setMultiOptions(
				$this->getMultiOptions($instructions, "name")
			);
		$this->addElement($element);

		$institutions = $this->getEm()->findAllActive("Institution");
		$element = $this->createElement("select", "institution")
			->setLabel("Instytucja")
			->setMultiOptions(
				$this->getMultiOptions($institutions, "name")
			);
		$this->addElement($element);

		$products = $this->getEm()->findAllActive("InstitutionProduct");
		$element = $this->createElement("select", "product")
			->setLabel("Produkt")
			->setMultiOptions(
				$this->getMultiOptions($products, "name")
			);
		$this->addElement($element);

		$element = $this->createElement("text", "date_from")
			->setLabel("Data zaw.")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "date_to")
			->setLabel("-")
			->setAttrib("class", "small");
		$this->addElement($element);

		$creditTypes = $this->getEm()->findAllActive("CreditType");
		$element = $this->createElement("select", "credit_type")
			->setLabel("Typ kredytu")
			->setMultiOptions(
				$this->getMultiOptions($creditTypes, "name")
			);
		$this->addElement($element);

		$currency = $this->getEm()->findAllActive("Currency");
		$element = $this->createElement("select", "currency")
			->setLabel("Waluta")
			->setMultiOptions(
				$this->getMultiOptions($creditTypes, "name")
			);
		$this->addElement($element);

		$element = $this->createElement("text", "credit_date_from")
			->setLabel("Data zaw.k.")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "credit_date_to")
			->setLabel("-")
			->setAttrib("class", "small");
		$this->addElement($element);

		$periods = array(0 => "") + range(0, 480);
		$element = $this->createElement("select", "period");
		$element->setRequired()
			->addValidator("Int")
			->setLabel("Okres")
			->setMultiOptions($periods);
		$this->addElement($element);

		$element = $this->createElement("text", "margin_from")
			->setLabel("Marża")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "margin_to")
			->setLabel("-")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "amount_from")
			->setLabel("Kwota")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "amount_to")
			->setLabel("-")
			->setAttrib("class", "small");
		$this->addElement($element);
	}
}