<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

/**
 * @method Document getModel() getModel()
 */
class Employees_SubForm_Document extends Application\Form\Subform
{
	public function init()
	{
		$element = $this->createElement("text", "document");
		$element->setRequired()
			->setLabel("Plik")
			->setValue($this->getModel()->path);
		$this->addElement($element);

		$element = $this->createElement("text", "name");
		$element->setRequired()
			->addFilter(new Zend_Filter_StringTrim())
			->setLabel("Nazwa")
			->setValue($this->getModel()->name);
		$this->addElement($element);

		$element = $this->createElement("text", "type");
		$element->setLabel("Typ")
			->addFilter(new Zend_Filter_StringTrim())
			->setValue($this->getModel()->type)
			->setDescription("opcjonalny typ dokumentu");
		$this->addElement($element);
	}
}