<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Trainings_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
	    $em = EntityManager::getInstance();

		$element = $this->createElement("text", "title");
		$element->setRequired()
			->addFilter("StringTrim")
			->setLabel("Tytuł")
			->setValue($this->getModel()->title);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->addFilter("StringTrim")
			->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->addValidator("Int")
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);

		$employees = $em->findAllActive("Employee");
		$element = $this->createElement("select", "employee");
		$element->addValidator(new Zend_Validate_Int())
    		->addFilter(new Zend_Filter_Null())
    		->setLabel("Egzaminator")
    		->setValue($this->getModel()->employee->getIdentifier())
    		->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")));
		$this->addElement($element);
	}
}