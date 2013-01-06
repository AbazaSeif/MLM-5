<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Configuration_SubForm_Storno extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "storno_interval");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Odstęp w miesiącach pomiędzy transzami")
			->setValue($this->getModel()->stornoInterval);
		$this->addElement($element);

		$element = $this->createElement("text", "storno_first_part_percent");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Procent dla pierwszej transzy")
			->setValue($this->getModel()->stornoFirstPartPercent);
		$this->addElement($element);

		$element = $this->createElement("text", "storno_second_part_percent");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->setLabel("Procent dla drugiej transzy")
			->setValue($this->getModel()->stornoSecondPartPercent);
		$this->addElement($element);
	}
}