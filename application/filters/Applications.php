<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Applications extends \Application\Filter\Filter
{
	public function filterByNumber($value)
	{
		$this->getSelect()->where("inner_number = '" . $value . "' OR outer_number = '" . $value . "'");
	}

	public function filterByCustomer($value)
	{
		$this->getSelect()->where("customer_id = ?", $value);
	}

	public function filterByEmployee($value)
	{
		$this->getSelect()->where("employee_id = ?", $value);
	}

	public function filterByProduct($value)
	{
		$this->getSelect()->where("product_id = ?", $value);
	}

	public function filterBySettlement($value)
	{
		$this->getSelect()->where("settlement_type_id = ?", $value);
	}

	public function filterByCurrency($value)
	{
		$this->getSelect()->where("currency_id = ?", $value);
	}

	public function filterByStatus($value)
	{
		$this->getSelect()->where("application_status_id = ?", $value);
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
