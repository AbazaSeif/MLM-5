<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Configuration_Form extends \Application\Form\Form
{
	public function init()
	{
		$incaso = new Configuration_SubForm_Incaso($this->getModel());
		$incaso->setLegend("Incaso");
		$this->addSubForm($incaso, "incaso");

		$storno = new Configuration_SubForm_Storno($this->getModel());
		$storno->setLegend("Storno");
		$this->addSubForm($storno, "storno");

		$taxFree = new Configuration_SubForm_TaxFree($this->getModel());
		$taxFree->setLegend("Podatek");
		$this->addSubForm($taxFree, "tax-free");
	}
}