<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Employees_SubForm_Customer extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();
		$customers = $em->findAllActive("Customer");
		$element = $this->createElement("select", "customer");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setLabel("Klient")
			->setValue($this->getModel()->getIdentifier())
			->setMultiOptions($this->getMultiOptions($customers, array("lastname", "firstname")));
		$this->addElement($element);
	}
}