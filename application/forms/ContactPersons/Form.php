<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class ContactPersons_Form extends \Application\Form\Form
{
	public function init()
	{
		$basic = new ContactPersons_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane personalne");
		$this->addSubForm($basic, "basic");

		$this->addTab("partner-list", "Lista partnerów", "contact-persons/partials/partner-list.phtml");
		$this->addTab("product-list", "Lista produktów", "contact-persons/partials/product-list.phtml");
	}
}