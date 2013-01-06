<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Trainings_SubForm_Basic extends \Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "title");
		$element->setRequired()
			->addFilter("StringTrim")
			->setLabel("Tytuł")
			->setValue($this->getModel()->title);
		$this->addElement($element);

		$element = $this->createElement("textarea", "description");
		$element->addFilter("StringTrim")
			->setLabel("Opis")
			->setValue($this->getModel()->description);
		$this->addElement($element);

		$element = $this->createElement("checkbox", "active");
		$element->setRequired()
			->addValidator("Int")
			->setLabel("Aktywność")
			->setChecked($this->getModel()->active);
		$this->addElement($element);
	}
}