<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Recruitment extends \Application\Filter\Filter
{
	public function filterByName($value)
	{
		$this->getSelect()->where("firstname like '%" . $value . "%' OR lastname like '%" . $value . "%'");
	}

	public function filterByEmployee($value)
	{
		$this->getSelect()->where("parent_employee_id = ?", $value);
	}

	public function filterByDateFrom($value)
	{
		$this->getSelect()->where("create_date >= ?", $value);
	}

	public function filterByDateTo($value)
	{
		$this->getSelect()->where("create_date <= ?", $value);
	}
}
