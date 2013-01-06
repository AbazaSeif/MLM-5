<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Customers_SubForm_Credit extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$creditTypes = $em->findAllActive("CreditType");
		$element = $this->createElement("select", "type");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Typ")
			->setMultiOptions($this->getMultiOptions($creditTypes, "name"))
			->setValue($this->getModel()->type->getIdentifier());
		$this->addElement($element);

		$element = $this->createElement("text", "bank");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter("StringTrim")
			->setLabel("Bank")
			->setValue($this->getModel()->bank);
		$this->addElement($element);

		$element = $this->createElement("text", "margin");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Marża")
			->setValue($this->getModel()->margin);
		$this->addElement($element);

		$element = $this->createElement("text", "rrso");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("RRSO")
			->setValue($this->getModel()->rrso);
		$this->addElement($element);

		$element = $this->createElement("text", "amount");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Kwota")
			->setValue($this->getModel()->amount);
		$this->addElement($element);

		$currency = $em->findAllActive("Currency");
		$element = $this->createElement("select", "currency");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Waluta")
			->setValue($this->getModel()->currency->getIdentifier())
			->setMultiOptions($this->getMultiOptions($currency, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "currency_rate");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Kurs waluty")
			->setValue($this->getModel()->currencyRate);
		$this->addElement($element);

		$element = $this->createElement("text", "installment");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Rata")
			->setValue($this->getModel()->installment);
		$this->addElement($element);

		$element = $this->createElement("text", "conclusion_date_start");
		$element->setRequired()
			->addValidator("Date")
			->setLabel("Data zawarcia")
			->setValue($this->getModel()->conclusionDateStart);
		$this->addElement($element);

		$periods = array(0 => "") + range(0, 480);
		$element = $this->createElement("select", "period_in_months");
		$element->setRequired()
			->addValidator("Int")
			->addValidator(new Zend_Validate_GreaterThan(0))
			->setLabel("Okres")
			->setMultiOptions($periods)
			->setValue($this->getModel()->periodInMonths);
		$this->addElement($element);

		$element = $this->createElement("text", "balance");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Saldo")
			->setValue($this->getModel()->balance);
		$this->addElement($element);

		$element = $this->createElement("text", "balance_date");
		$element->addValidator("Date")
			->setLabel("Na dzień")
			->setValue($this->getModel()->balanceDate);
		$this->addElement($element);

		$element = $this->createElement("text", "cost_of_repayment");
		$element->addValidator("Float")
			->setLabel("Koszt spłaty")
			->setValue($this->getModel()->costOfRepayment);
		$this->addElement($element);
	}
}