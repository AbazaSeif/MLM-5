<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Form_Partners extends \Application\Filter\Form
{
	public function init()
	{
		$element = $this->createElement("text", "name")
			->setLabel("Nazwa");
		$this->addElement($element);

		$contactPersons = $this->getEm()->findAllActive("ContactPerson");
		$element = $this->createElement("select", "contact")
			->setLabel("Kontakt")
			->setMultiOptions(
				$this->getMultiOptions($contactPersons, array("lastname", "firstname"))
			);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active")
			->setLabel("Aktywność");
		$this->addElement($element);
	}
}