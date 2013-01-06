<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Institutions_SubForm_Product extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$institutions = $em->findAllActive("Institution");
		$element = $this->createElement("select", "institution");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setLabel("Instytucja")
			->setValue($this->getModel()->institution->getIdentifier())
			->setMultiOptions($this->getMultiOptions($institutions, "name"));
		$this->addElement($element);

		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addValidator(new Zend_Validate_Alnum(array("allowWhiteSpace" => true)))
			->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
			->addValidator(
				new Zend_Validate_Db_NoRecordExists(
					array(
						"table" 	=> "institutions",
						"field"	=> "name",
						"exclude" => array(
							"field" => "institution_id",
							"value" => $this->getModel()->getIdentifier()
						)
					)
				)
			)
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->addValidator(new Zend_Validate_Int())
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}