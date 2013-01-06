<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Products_TypeForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Products_SubForm_Type($this->getModel());
		$basic->setLegend("Dane podstawowe");
		$this->addSubForm($basic, "basic");
	}
}