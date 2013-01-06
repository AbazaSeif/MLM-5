<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Customers_StatusForm extends \Application\Form\Form
{
	public function init()
	{
		$status = new Customers_SubForm_Status($this->getModel());
		$status->setLegend("Dane podstawowe");
		$this->addSubForm($status, "status");
	}
}