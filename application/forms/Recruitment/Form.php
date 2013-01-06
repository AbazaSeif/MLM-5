<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Recruitment_Form extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Recruitment_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane personalne");
		$this->addSubForm($basic, "basic");
		$this->setAttrib("id", "recruit-form");

		$this->addTab("document-list", "Lista dokumentów", "recruitment/partials/document-list.phtml");
	}
}