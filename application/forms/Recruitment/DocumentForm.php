<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Recruitment_DocumentForm extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Recruitment_SubForm_Document($this->getModel());
		$basic->setEnctype("multipart/form-data")
			->setLegend("Dokument");
		$this->addSubForm($basic, "basic");

		$element = $this->createElement("hidden", "parent");
		$this->addElement($element);
	}
}