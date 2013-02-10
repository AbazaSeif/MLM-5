<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Applications_SubForm_Settlement extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$settlementTypes = $em->findAllActive("SettlementType");
		$element = $this->createElement("select", "settlement_type");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Forma rozliczenia")
			->setValue($this->getModel()->settlementType->getIdentifier())
			->setMultiOptions($this->getMultiOptions($settlementTypes, "name"));
		$this->addElement($element);

		$currency = $em->findAllActive("Currency");
		$element = $this->createElement("select", "currency");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Waluta")
			->setValue($this->getModel()->currency->getIdentifier())
			->setMultiOptions($this->getMultiOptions($currency, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "currency_rate");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Kurs waluty")
			->setValue($this->getModel()->currencyRate);
		$this->addElement($element);

		$element = $this->createElement("text", "investment_target");
		$element->addFilter("StringTrim")
			->setLabel("Cel inwestycyjny")
			->setValue($this->getModel()->investmentTarget);
		$this->addElement($element);

		$element = $this->createElement("text", "conclusion_date_start");
		$element->setRequired()
			->addValidator("Date")
			->setLabel("Data zawarcia")
			->setValue($this->getModel()->conclusionDateStart);
		$this->addElement($element);

		$element = $this->createElement("text", "conclusion_date_end");
		$element->addValidator("Date")
			->addFilter("Null")
			->setLabel("Data zakończenia")
			->setValue($this->getModel()->conclusionDateEnd);
		$this->addElement($element);

		$element = $this->createElement("text", "insurance_sum");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Suma ubezpieczenia")
			->setValue($this->getModel()->insuranceSum);
		$this->addElement($element);

		$premiumTypes = $em->findAllActive("PremiumType");
		$element = $this->createElement("select", "premium_type");
		$element->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Typ składki")
			->setValue($this->getModel()->premiumType->getIdentifier())
			->setMultiOptions($this->getMultiOptions($premiumTypes, 'name'));

		if ($this->getModel()->premiumType->getIdentifier()) {
			$element->setAttrib("disabled", "disabled");
		}
		$this->addElement($element);

		$element = $this->createElement("text", "premium");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Składka")
			->setValue($this->getModel()->premium);
		$this->addElement($element);

		$element = $this->createElement("text", "amount");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Wartość")
			->setValue($this->getModel()->amount);
		$this->addElement($element);

		$element = $this->createElement("text", "margin");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Marża")
			->setValue($this->getModel()->margin);
		$this->addElement($element);

		$element = $this->createElement("text", "cost_of_repayment");
		$element->addValidator("Float")
			->setLabel("Koszt spłaty")
			->setValue($this->getModel()->costOfRepayment);
		$this->addElement($element);
	}
}