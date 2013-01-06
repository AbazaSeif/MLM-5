<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Access\Manager;

class Employees_SubForm_Access extends \Application\Form\Subform
{
    public function init()
    {
    	$modules = Manager::getModules();
    	$employeeAccess = $this->getModel()->access;

        foreach ($modules as $name => $translation) {
        	$moduleName = "MODULE_" . strtoupper($name);
        	$module = constant("\Application\Access\Manager::" . $moduleName);

        	$element = $this->createElement("select", $moduleName);
        	$element->setLabel($translation)
        		->addValidator("Int")
        		->addFilter("Int")
        		->setMultiOptions(Manager::getActions())
        		->setValue(Manager::getValue($employeeAccess, $module));
        	$this->addElement($element);
        }

        $element = $this->createElement("checkbox", "GRANT_OPTION");
        $element->setLabel("Nadawanie uprawnień")
	        ->addValidator("Int")
	        ->addFilter("Int")
	        ->setValue(Manager::hasGrantOption($employeeAccess));
        $this->addElement($element);
    }
}