<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Products extends \Application\Filter\Filter
{
	public function filterByName($value)
	{
		$this->getSelect()->where("name like '%" . $value . "%'");
	}

	public function filterByPartner($value)
	{
		$this->getSelect()->where("partner_id = ?", $value);
	}

	public function filterByType($value)
	{
		$this->getSelect()->where("product_type_id = ?", $value);
	}

	public function filterByCurrency($value)
	{
		$this->getSelect()->where("currency_id = ?", $value);
	}

	public function filterByContact($value)
	{
		$this->getSelect()->where("contact_person_id = ?", $value);
	}

	public function filterBySettlement($value)
	{
		$this->getSelect()->where("settlement_type_id = ?", $value);
	}

	public function filterByActive($value)
	{
		$this->getSelect()->where("active = 1");
	}
}