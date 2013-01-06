<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * Product Basic subform
 * @method Product getModel() getModel()
 */
class Products_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$partners = $em->findAllActive("Partner");
		$element = $this->createElement("select", "partner");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Partner")
			->setValue($this->getModel()->partner->getIdentifier())
			->setMultiOptions($this->getMultiOptions($partners, "name"));
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

		$contactPersons = $em->findAllActive("ContactPerson");
		$element = $this->createElement("select", "contact_person");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Kontakt")
			->setMultiOptions($this->getMultiOptions($contactPersons, array("lastname", "firstname")))
			->setValue($this->getModel()->contactPerson->getIdentifier());
		$this->addElement($element);

		$productTypes = $em->findAllActive("ProductType");
		$element = $this->createElement("select", "product_type");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Typ")
			->setValue($this->getModel()->type->getIdentifier())
			->setMultiOptions($this->getMultiOptions($productTypes, "name"));
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}