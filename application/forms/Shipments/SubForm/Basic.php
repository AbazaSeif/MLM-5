<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * Shipment Basic subform
 *
 * @method Shipment getModel() getModel()
 */
class Shipments_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$shipmentTypes = $em->findAllActive("ShipmentType");
		$element = $this->createElement("select", "type");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Typ")
			->setValue($this->getModel()->type)
			->setMultiOptions($this->getMultiOptions($shipmentTypes, "name"));
		$this->addElement($element);

		$this->getModel()->

		$element = $this->createElement("text", "street");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alnum(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Ulica")
			->setValue($this->getModel()->street);
		$this->addElement($element);

		$element = $this->createElement("text", "city");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Miasto")
			->setValue($this->getModel()->city);
		$this->addElement($element);

		$element = $this->createElement("text", "postcode");
		$element->setRequired()
			->addValidator(new Zend_Validate_PostCode(Zend_Registry::get(\Application\Registry\Registry::LOCALE)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Kod pocztowy")
			->setValue($this->getModel()->postcode);
		$this->addElement($element);

		$states = $em->findAll("State");
		$element = $this->createElement("select", "state");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Województwo")
			->setValue($this->getModel()->state->getIdentifier())
			->setMultiOptions($this->getMultiOptions($states, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "phone_number");
		$element->setRequired()
			->addFilter(new Zend_Filter_StringTrim())
			->setlabel('Numer telefonu')
			->setValue($this->getModel()->phoneNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "email");
		$element->setRequired()
			->addValidator(new Zend_Validate_EmailAddress())
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Email")
			->setValue($this->getModel()->email);
		$this->addElement($element);
	}
}