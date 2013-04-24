<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Employees extends \Application\Filter\Filter
{
	public function filterByName($value)
	{
		$this->getSelect()->where("firstname like '%" . $value . "%' OR lastname like '%" . $value . "%' OR login like '%" . $value . "%'");
	}

	public function filterByPhone($value)
	{
		$this->getSelect()->where("phone_number = '" . $value . "' OR cell_phone_number = '" . $value . "'");
	}

	public function filterByEmail($value)
	{
		$this->getSelect()->where("email = ?", $value);
	}

	public function filterByPosition($value)
	{
		$this->getSelect()->where("employee_position_id = ?", $value);
	}

	public function filterByGroup($value)
	{
		$this->getSelect()->where("employee_group_id = ?", $value);
	}

	public function filterByAgreement($value)
	{
		$this->getSelect()->where("agreement_type_id = ?", $value);
	}

	public function filterByActive($value)
	{
		$this->getSelect()->where("active = 1");
	}
}
