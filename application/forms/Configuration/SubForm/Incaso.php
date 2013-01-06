<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Configuration_SubForm_Incaso extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "incaso_parts");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Ilość transz")
			->setValue($this->getModel()->incasoParts);
		$this->addElement($element);
	}
}