<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Applications_StatusForm extends \Application\Form\Form
{
	public function init()
	{
		$status = new Applications_SubForm_Status($this->getModel());
		$status->setLegend("Dane podstawowe");
		$this->addSubForm($status, "basic");
	}
}