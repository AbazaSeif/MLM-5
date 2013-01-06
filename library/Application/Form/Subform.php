<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Form;

class Subform extends \Application\Form\Form
{
	public function loadDefaultDecorators()
	{
		$this->addDecorator("FormElements")
			->addDecorator("HtmlTag", array("tag" => "ul", "class" => "list-style-none"))
			->addDecorator("Fieldset");

		$this->setElementDecorators($this->getElementDecorators());
	}

	public function getElementDecorators($isFile = false)
	{
		if ($isFile) {
			$viewHelper = array("File", array("class" => "file"));
		} else {
			$viewHelper = "ViewHelper";
		}

		return array(
			$viewHelper,
			array("Label", array(
				"requiredSuffix" => "*"
			)),
			array("Description", array("tag" => "em")),
			"Errors",
			array("HtmlTag", array(
				"tag" 	=> "li",
				"class"	=> "input-line"
			))
		);
	}

	public function getElementDecoratorsForFile()
	{
		return $this->getElementDecorators(true);
	}

	public function render(\Zend_View $view = null)
	{
		foreach ($this->getElements() as $name => $element) {
			if ($element instanceof \Zend_Form_Element_File) {
				$element->setDecorators($this->getElementDecoratorsForFile());
			}
		}

		return parent::renderWithoutSubmitButton($view);
	}
}