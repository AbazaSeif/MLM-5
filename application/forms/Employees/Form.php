<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Access\Manager;

/**
 * Employee Form
 *
 * @author Adrian Wądrzyk
 */
class Employees_Form extends \Application\Form\Form
{
	public function init()
	{
		$login = new Employees_SubForm_Login($this->getModel());
		$login->setLegend("Dane do logowania");
		$this->addSubForm($login, "login-form");

		$basic = new Employees_SubForm_Basic($this->getModel());
		$basic->setLegend("Dane personalne");
		$this->addSubForm($basic, "basic");

		$agreement = new Employees_SubForm_Agreement($this->getModel());
		$agreement->setLegend("Umowa");
		$this->addSubForm($agreement, "agreement");

		$this->addTab("address-list", "Lista adresów", "employees/partials/address-list.phtml");
		$this->addTab("document-list", "Lista dokumentów", "employees/partials/document-list.phtml");
		$this->addTab("customers-list", "Lista klientów", "employees/partials/customers-list.phtml");
		//$this->addTab("privileges-list", "Lista przywilejów", "employees/partials/privilege-list.phtml");
		$this->addTab("trainings-list", "Szkolenia", "employees/partials/training-list.phtml");

		$employee = \Zend_Auth::getInstance()->getIdentity();
		if (Manager::hasGrantOption($employee->access)) {
			$access = new Employees_SubForm_Access($this->getModel());
			$access->setLegend("Uprawnienia");
			$this->addSubForm($access, "access");
		}
	}
}