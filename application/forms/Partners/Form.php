<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Partners_Form extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Partners_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane podstawowe");
		$this->addSubForm($basic, "basic");

		$this->addTab("product-list", "Lista produktów", "partners/partials/product-list.phtml");
	}
}