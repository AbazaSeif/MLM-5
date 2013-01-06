<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Customers_SubForm_OldProduct extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$instructions = $em->findAllActive("Instruction");
		$element = $this->createElement("select", "instruction");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setLabel("Instrument")
			->setValue($this->getModel()->instruction->getIdentifier())
			->setMultiOptions($this->getMultiOptions($instructions, "name"));
		$this->addElement($element);

		$institutions = $em->findAllActive("Institution");
		$element = $this->createElement("select", "institution");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setLabel("Instytucja")
			->setValue($this->getModel()->institution->getIdentifier())
			->setMultiOptions($this->getMultiOptions($institutions, "name"))
			->setAttrib("rel", "/json/institution/get-products");
		$this->addElement($element);

		$institutionProducts = $em->findAllActive("InstitutionProduct");
		$element = $this->createElement("select", "institution_product");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setLabel("Produkt Instytucji")
			->setValue($this->getModel()->institutionProduct->getIdentifier())
			->setMultiOptions($this->getMultiOptions($institutionProducts, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "policy_number");
		$element->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
			->addValidator(new Zend_Validate_Digits())
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer polisy")
			->setValue($this->getModel()->policyNumber);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$element = $this->createElement("text", "insurance_sum");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Suma ubezpieczenia")
			->setValue($this->getModel()->insuranceSum);
		$this->addElement($element);

		$element = $this->createElement("text", "insurance_sum_nnw");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Suma ubezpieczenia NNW")
			->setValue($this->getModel()->insuranceSumNnw);
		$this->addElement($element);

		$element = $this->createElement("text", "insurance_sum_nkw");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Suma ubezpieczenia NWK")
			->setValue($this->getModel()->insuranceSumNwk);
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

		$element = $this->createElement("text", "fee");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->setLabel("Opłata")
			->setValue($this->getModel()->fee);
		$this->addElement($element);

		$premiumTypes = $em->findAllActive("PremiumType");
		$element = $this->createElement("select", "premium_type");
		$element->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Typ składki")
			->setValue($this->getModel()->premiumType->getIdentifier())
			->setMultiOptions($this->getMultiOptions($premiumTypes, 'name'));
		$this->addElement($element);

		$element = $this->createElement("text", "contribution");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Wkład / limit")
			->setValue($this->getModel()->contribution);
		$this->addElement($element);

		$element = $this->createElement("text", "amount");
		$element->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Wartość")
			->setValue($this->getModel()->amount);
		$this->addElement($element);

		$element = $this->createElement("text", "create_date");
		$element->addValidator("Date")
			->addFilter("Null")
			->setLabel("Na dzień")
			->setValue($this->getModel()->createDate);
		$this->addElement($element);
	}
}