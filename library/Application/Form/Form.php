<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Form;

/**
 * Form
 */
use DataMapper\Application;
use \Application\Access\Manager;

abstract class Form extends \Zend_Form
{
	private $_model;
	private $_tabs = array();

	public function __construct(\Application\Entity\Entity $model)
	{
		$this->_model = $model;
		$this->addPrefixPath("Application\Form\Decorator\\", "Application/Form/Decorator", "decorator");
		parent::__construct();
	}

	/**
	 * @return \Application\Entity\Entity
	 */
	public function getModel()
	{
		return $this->_model;
	}

	public function setModel(\Application\Entity\Entity $model)
	{
		$this->_model = $model;
	}

	public function loadDefaultDecorators()
	{
		$this->addDecorator("Partial")
			->addDecorator("FormElements")
			->addDecorator("FormInfo")
			->addDecorator("Form", array("class" => "form"))
			->addDecorator("Tabs")
			->addDecorator("HtmlTag", array("tag" => "div", "class" => "form-container"));
	}

	public function render(\Zend_View $view = null)
	{
	    $request = \Zend_Controller_Front::getInstance()->getRequest();
	    $hasPrivilege = \Application\Controller\Plugin\Privileges::hasPrivilige($request, Manager::ACTION_UPDATE);

	    if ($hasPrivilege) {
    		$element = $this->createElement("submit", "submit");
    		$element->setLabel("Zapisz")
    			->setIgnore(true)
    			->setDecorators(
    				array(
    					"ViewHelper",
    					array(
    						"HtmlTag",
    						array(
    							"tag" 	=> "div",
    							"class" 	=> "input-line buttons"
    						)
    					)
    				)
    			);
    		$this->addElement($element);
	    }

		return parent::render($view);
	}

	public function renderWithoutSubmitButton(\Zend_View $view = null)
	{
		return parent::render($view);
	}

	public function addTab($name, $legend, $partial)
	{
		$this->_tabs[] = new Tab($name, $legend, $partial);
	}

	public function getTabs()
	{
		return $this->_tabs;
	}

	public static function getMultiOptions(array $collection, $valueKey, $withEmptyOption = true)
	{
		$multiOptions = array();

		if ($withEmptyOption) {
		    $multiOptions[] = null;
		}

		$valueKey = (array)$valueKey;

		foreach ($collection as $model) {
			$values = array();
			foreach ($valueKey as $key) {
				$values[] = $model->$key;
			}

			$multiOptions[$model->getIdentifier()] = implode(" ", $values);
		}

		asort($multiOptions);

		return $multiOptions;
	}
}
