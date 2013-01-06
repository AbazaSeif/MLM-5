<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Filter;

use \Application\Entity\EntityManager;

class Form extends \Zend_Form
{
	public function getEm()
	{
		return $em = EntityManager::getInstance();
	}

	public static function getMultiOptions(array $collection, $valueKey, $withEmptyOption = true)
	{
		return \Application\Form\Form::getMultiOptions($collection, $valueKey, $withEmptyOption);
	}

	public function loadDefaultDecorators()
	{
		$this->addDecorator("FormElements")
			->addDecorator("Form", array("class" => "form filter-form"));

		$this->setElementDecorators(
			array(
				"ViewHelper",
				"Label",
				array("HtmlTag", array("tag" => "li"))
			)
		);
	}

	public function render(\Zend_View $view = null)
	{
		$elementsGroup = array();
		foreach ($this->getElements() as $element) {
			$elementsGroup[] = $element->getName();
		}
		$this->addDisplayGroup($elementsGroup, "elements");
		$this->setLegend("testowa");

		$this->_addDisplayGroupWithButtons();
		$this->_setDisplayGroupDecorators();
		$this->_addValuesForElements();

		return parent::render($view);
	}

	private function _addDisplayGroupWithButtons()
	{
		$decorators = $this->_getButtonsDecorators();

		$element = $this->createElement("submit", "submit");
		$element->setLabel("Filtruj")
			->setIgnore(true)
			->setDecorators($decorators);
		$this->addElement($element);

		$element = $this->createElement("submit", "reset");
		$element->setLabel("Wyczyść")
			->setDecorators($decorators);
		$this->addElement($element);

		$this->addDisplayGroup(array("submit", "reset"), "buttons");
	}

	private function _getButtonsDecorators()
	{
		return array(
			"ViewHelper",
			array(
				"HtmlTag",
				array(
					"tag" 	=> "li"
				)
			)
		);
	}

	private function _setDisplayGroupDecorators()
	{
		$this->setDisplayGroupDecorators(
			array(
				"FormElements",
				array("HtmlTag", array("tag" => "ul")),

				"Fieldset"
			)
		);
	}

	private function _addValuesForElements()
	{
		$request = \Zend_Controller_Front::getInstance()->getRequest();
		$filterName = "\Filter_" . ucfirst($request->getControllerName());
		$filter = new $filterName();

		foreach ($filter->getFilterData() as $key => $value) {
			$element = $this->getElement($key);
			if ($element && !empty($value)) {
				$element->setValue($value);
				$element->setAttrib("class", $element->getAttrib("class") . " active");
			}
		}

	}
}