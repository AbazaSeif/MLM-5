<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Form_Recruitment extends \Application\Filter\Form
{
	public function init()
	{
		$element = $this->createElement("text", "name")
			->setLabel("Nazwa");
		$this->addElement($element);

		$employees = $this->getEm()->findAllActive("Employee");
		$element = $this->createElement("select", "employee")
			->setLabel("Pracownik")
			->setMultiOptions($this->getMultiOptions($employees, array("lastname", "firstname")));
		$this->addElement($element);

		$element = $this->createElement("text", "date_from")
			->setLabel("Data")
			->setAttrib("class", "small");
		$this->addElement($element);

		$element = $this->createElement("text", "date_to")
			->setLabel("-")
			->setAttrib("class", "small");
		$this->addElement($element);
	}
}