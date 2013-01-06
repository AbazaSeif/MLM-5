<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Settlements extends \Application\Filter\Filter
{
	public function filterByEmployee($value)
	{
		$this->getSelect()->where("employee_id = ?", $value);
	}

	public function filterByDateFrom($value)
	{
		$this->getSelect()->where("create_date >= ?", $value);
	}

	public function filterByDateTo($value)
	{
		$this->getSelect()->where("create_date <= ?", $value);
	}

	public function filterByAmountFrom($value)
	{
		$this->getSelect()->where("total >= ?", $value);
	}

	public function filterByAmountTo($value)
	{
		$this->getSelect()->where("total <= ?", $value);
	}
}