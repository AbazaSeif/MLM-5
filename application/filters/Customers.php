<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Customers extends \Application\Filter\Filter
{
	public function filterByName($value)
	{
		$this->getSelect()->where("firstname like '%" . $value . "%' OR lastname like '%" . $value . "%'");
	}

	public function filterByPhone($value)
	{
		$this->getSelect()->where("phone_number = '" . $value . "' OR cell_phone_number = '" . $value . "'");
	}

	public function filterByEmail($value)
	{
		$this->getSelect()->where("email = ?", $value);
	}

	public function filterByEmployee($value)
	{
		$this->getSelect()->where("employee_id = ?", $value);
	}

	public function filterByCity($value)
	{
		$this->getSelect()->joinNatural("customer_addresses", array())
			->where("city = ?", $value);
	}

	public function filterByGroup($value)
	{
		$this->getSelect()->where("group_id = ?", $value);
	}

	public function filterByInstruction($value)
	{
		$this->getSelect()->joinNatural("customer_old_products", array())
			->where("instruction_id = ?", $value);
	}

	public function filterByInstitution($value)
	{
		$this->getSelect()->joinNatural("customer_old_products", array())
			->where("institution_id = ?", $value);
	}

	public function filterByProduct($value)
	{
		$this->getSelect()->joinNatural("customer_old_products", array())
			->where("institution_product_id = ?", $value);
	}

	public function filterByDateFrom($value)
	{
		$this->getSelect()->joinNatural("customer_old_products", array())
			->where("customer_old_products.conclusion_date_start >= ?", $value);
	}

	public function filterByDateTo($value)
	{
		$this->getSelect()->joinNatural("customer_old_products", array())
			->where("customer_old_products.conclusion_date_end <= ?", $value);
	}

	public function filterByCreditType($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("credit_type_id = ?", $value);
	}

	public function filterByCurreny($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("currency_id <= ?", $value);
	}

	public function filterByCreditDateFrom($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("customer_credits.conclusion_date_start >= ?", $value);
	}

	public function filterByCreditDateTo($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("customer_credits.conclusion_date_end <= ?", $value);
	}

	public function filterByPeriod($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("period_in_months = ?", $value);
	}

	public function filterByMarginFrom($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("margin >= ?", $value);
	}

	public function filterByMarginTo($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			>where("margin <= ?", $value);
	}

	public function filterByAmountFrom($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("amount >= ?", $value);
	}

	public function filterByAmountTo($value)
	{
		$this->getSelect()->joinNatural("customer_credits", array())
			->where("amount <= ?", $value);
	}
}
