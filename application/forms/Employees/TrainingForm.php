<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Employees_TrainingForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Employees_SubForm_Training($this->getModel());
		$basic->setLegend("Szkolenia pracownika");
		$this->addSubForm($basic, "basic");

		$element = $this->createElement("hidden", "parent");
		$this->addElement($element);
	}
}