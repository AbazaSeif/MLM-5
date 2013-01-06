<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Trainings_Form extends \Application\Form\Form
{
	public function init()
	{
		$basic = new Trainings_SubForm_Basic($this->getModel());
		$basic->setLegend("Szkolenie");
		$this->addSubForm($basic, 'basic');
	}
}