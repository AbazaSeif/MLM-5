<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * @method Employee getModel() getModel()
 */
class Employees_SubForm_Agreement extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$agreementTypes = $em->findAllActive("AgreementType");
		$element = $this->createElement("select", "agreement_type");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Typ umowy")
			->setValue($this->getModel()->agreementType->getIdentifier())
			->setMultiOptions($this->getMultiOptions($agreementTypes, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "agreement_number");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer umowy")
			->setValue($this->getModel()->agreementNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "agreement_start_date");
		$element->setRequired()
			->addValidator(new Zend_Validate_Date())
			->setLabel("Data rozpoczęcia umowy")
			->setValue($this->getModel()->agreementStartDate);
		$this->addElement($element);

		$element = $this->createElement("text", "agreement_end_date");
		$element->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Data zakończenia umowy")
			->setValue($this->getModel()->agreementEndDate);
		$this->addElement($element);

		$element = $this->createElement("text", "company_name");
		$element->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa firmy")
			->setValue($this->getModel()->companyName);
		$this->addElement($element);

		$element = $this->createElement("text", "student_card_expiration_date");
		$element->setLabel("Data ważności legitymacji")
			->addValidator(new Zend_Validate_Date())
			->addFilter(new Zend_Filter_Null())
			->setValue($this->getModel()->studentCardExpirationDate);
		$this->addElement($element);

		$element = $this->createElement("text", "birth_date");
		$element->setRequired()
			->addValidator(new Zend_Validate_Date())
			->setLabel("Data urodzenia")
			->setValue($this->getModel()->birthDate);
		$this->addElement($element);

		$element = $this->createElement("text", "birth_city");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Miejsce urodzenia")
			->setValue($this->getModel()->birthCity);
		$this->addElement($element);

		$element = $this->createElement("text", "mother_name");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alpha(array("allowWhitespace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Imię matki")
			->setValue($this->getModel()->motherName);
		$this->addElement($element);

		$element = $this->createElement("text", "father_name");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alpha(array("allowWhitespace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Imię ojca")
			->setValue($this->getModel()->fatherName);
		$this->addElement($element);

		$element = $this->createElement("text", "identity_card");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alnum())
			->addValidator(new Zend_Validate_StringLength(array("max" => 10)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer dowodu os.")
			->setValue($this->getModel()->identityCard);
		$this->addElement($element);

		$element = $this->createElement("text", "pesel");
		$element->setRequired()
			->addValidator(new Zend_Validate_Digits())
			->addValidator(new Zend_Validate_StringLength(array("min" => 11, "max" => 11)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("PESEL")
			->setValue($this->getModel()->pesel);
		$this->addElement($element);

		$element = $this->createElement("text", "nip");
		$element->addValidator(new Zend_Validate_Digits())
			->addValidator(new Zend_Validate_StringLength(array("max" => "15")))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("NIP")
			->setValue($this->getModel()->nip);
		$this->addElement($element);

		$element = $this->createElement("text", "regon");
		$element->addValidator(new Zend_Validate_Int())
			->addValidator(new Zend_Validate_StringLength(array("max" => "15")))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("REGON")
			->setValue($this->getModel()->regon);
		$this->addElement($element);

		$element = $this->createElement("text", "bank_name");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa banku")
			->setValue($this->getModel()->bankName);
		$this->addElement($element);

		$element = $this->createElement("text", "bank_account");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("min" => 26, "max" => 26)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer konta")
			->setValue($this->getModel()->bankAccount);
		$this->addElement($element);
	}
}