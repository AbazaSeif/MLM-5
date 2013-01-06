<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Configuration_SubForm_TaxFree extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "tax_free_allowance");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Kwota wolna od podatku")
			->setValue($this->getModel()->taxFreeAllowance);
		$this->addElement($element);

		$element = $this->createElement("text", "tax_percent");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Podatek")
			->setValue($this->getModel()->taxPercent);
		$this->addElement($element);
	}
}