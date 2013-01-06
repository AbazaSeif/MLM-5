<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class Products_SubForm_Settlement extends \Application\Form\Subform
{
	public function init()
	{
		$em = EntityManager::getInstance();

		$settlementTypes = $em->findAllActive("SettlementType");
		$element = $this->createElement("select", "settlement_type");
		$element->setRequired()
			->addValidator(new Zend_Validate_Int())
			->addFilter(new Zend_Filter_Null())
			->setLabel("Forma rozliczenia")
			->setMultiOptions($this->getMultiOptions($settlementTypes, "name"))
			->setValue($this->getModel()->settlementType->getIdentifier());
		$this->addElement($element);

		$element = $this->createElement("text", "seller_percent");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Sprzedaż umowy")
			->setValue($this->getModel()->sellerPercent);
		$this->addElement($element);

		$employeePositions = $em->findAllActive("EmployeePosition");
		foreach ($employeePositions as $employeePosition) {
			$element = $this->createElement("text", "employee_position_" . $employeePosition->getIdentifier());
			$element->setRequired()
				->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
				->setLabel($employeePosition->name)
				->setValue($this->_findPercentForPosition($this->getModel()->percents, $employeePosition));
			$this->addElement($element);
		}
	}

	protected function _findPercentForPosition(
		\Application\Model\Collection\Collection $percents,
		\Entity\EmployeePosition $position)
	{
		foreach ($percents as $percent) {
			if ($percent->employeePosition == $position) {
				return $percent->value;
			}
		}

		return null;
	}
}