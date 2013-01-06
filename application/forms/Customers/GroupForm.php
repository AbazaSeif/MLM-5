<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Customers_GroupForm extends \Application\Form\Form
{
	public function init()
	{
		$group = new Customers_SubForm_Group($this->getModel());
		$group->setLegend("Dane podstawowe");
		$this->addSubForm($group, "basic");
	}
}