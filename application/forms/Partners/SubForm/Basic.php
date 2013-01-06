<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * Partner Basic subform
 * @method Partner getModel() getModel()
 */
class Partners_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alnum(array("allowWhitespace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addValidator(new Zend_Validate_Db_NoRecordExists(array(
				"table"	=> "partners",
				"field"	=> "name",
				"exclude" => array(
					"field" => "partner_id",
					"value" => $this->getModel()->getIdentifier()
				)
			)))
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$contactPersons = $em->findAllActive("ContactPerson");
		$element = $this->createElement("select", "contact_person");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Kontakt")
			->setValue($this->getModel()->contactPerson->getIdentifier())
			->setMultiOptions($this->getMultiOptions($contactPersons, array("lastname", "firstname")));
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}