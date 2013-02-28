<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class Customers_SubForm_History extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$element = $this->createElement("text", "date");
		$element->setRequired()
			->addValidator("Date")
			->setLabel("Data")
			->setValue($this->getModel()->date);
		$this->addElement($element);

		$element = $this->createElement("textarea", "info");
		$element->setRequired()
		    ->setLabel("Informacja")
			->setValue($this->getModel()->info);
		$this->addElement($element);
	}
}