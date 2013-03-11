<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Applications_SimpleForm extends \Application\Form\Form
{
	public function init()
	{
		$basic  = new Applications_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane podstawowe");
		$this->addSubForm($basic, "basic");

		$settlement = new Applications_SubForm_Settlement($this->getModel());
		$settlement->setLegend("Rozliczenie");
		$this->addSubForm($settlement, "settlement");
	}
}