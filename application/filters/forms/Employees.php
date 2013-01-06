<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Form_Employees extends \Application\Filter\Form
{
	public function init()
	{
		$element = $this->createElement("text", "name")
			->setLabel("Nazwa");
		$this->addElement($element);

		$element = $this->createElement("text", "phone")
			->setLabel("Telefon");
		$this->addElement($element);

		$element = $this->createElement("text", "email")
			->setLabel("Email");
		$this->addElement($element);

		$positions = $this->getEm()->findAllActive("EmployeePosition");
		$element = $this->createElement("select", "position")
			->setLabel("Stanowisko")
			->setMultiOptions(
				$this->getMultiOptions($positions, "name")
			);
		$this->addElement($element);

		$groups = $this->getEm()->findAllActive("EmployeeGroup");
		$element = $this->createElement("select", "group")
			->setLabel("Grupa")
			->setMultiOptions(
				$this->getMultiOptions($groups, "name")
			);
		$this->addElement($element);

		$agreementType = $this->getEm()->findAllActive("AgreementType");
		$element = $this->createElement("select", "agreement")
			->setLabel("Umowa")
			->setMultiOptions(
				$this->getMultiOptions($agreementType, "name")
			);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active")
			->setLabel("Aktywność");
		$this->addElement($element);
	}
}