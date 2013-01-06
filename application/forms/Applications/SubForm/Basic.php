<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * Application Status subform
 * @method Application getModel() getModel()
 */
class Applications_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "inner_number");
		$element->setRequired()
			->addValidator(new Zend_Validate_Regex("/^\d{3}\/\d{2}\/\d{4}$/"))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer wewnętrzny")
			->setDescription("format NNN/MM/RRRR, N - numer, M - miesiąc, R - rok")
			->setValue($this->getModel()->innerNumber);
		$this->addElement($element);

		$element = $this->createElement("text", "outer_number");
		$element->setRequired()
			->addValidator(new Zend_Validate_StringLength(array("max" => 50)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Numer zewnętrzny")
			->setValue($this->getModel()->outerNumber);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$statuses = $em->findAllActive("ApplicationStatus");
		$element = $this->createElement("select", "status");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Status")
			->setValue($this->getModel()->status->getIdentifier())
			->setMultiOptions($this->getMultiOptions($statuses, "name"));
		$this->addElement($element);

		$customers = $em->findAllActive("Customer");
		$element = $this->createElement("select", "customer");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Klient")
			->setValue($this->getModel()->customer->getIdentifier())
			->setMultiOptions($this->getMultiOptions($customers, array("lastname", "firstname")));
		$this->addElement($element);

		$employees = $em->findAllActive("Employee");
		$element = $this->createElement("select", "employee");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Pracownik")
			->setValue($this->getModel()->employee->getIdentifier())
			->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")));
		$this->addElement($element);

		$employees = $em->findAllActive("Employee");
		$element = $this->createElement("select", "seller");
		$element->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Sprzedaż umowy")
			->setValue($this->getModel()->seller->getIdentifier())
			->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")));
		$this->addElement($element);

		$partners = $em->findAllActive("Partner");
		$element = $this->createElement("select", "partner");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Partner")
			->setValue($this->getModel()->partner->getIdentifier())
			->setMultiOptions($this->getMultiOptions($partners, "name"))
			->setAttrib("rel", "/json/partners/get-products");
		$this->addElement($element);

		$products = $em->findAllActive("Product");
		$element = $this->createElement("select", "product");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Produkt")
			->setValue($this->getModel()->product->getIdentifier())
			->setMultiOptions($this->getMultiOptions($products, "name"));
		$this->addElement($element);
	}
}