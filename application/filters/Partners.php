<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Filter_Partners extends \Application\Filter\Filter
{
	public function filterByName($value)
	{
		$this->getSelect()->where("name like '%" . $value . "%'");
	}

	public function filterByContact($value)
	{
		$this->getSelect()->where("contact_person_id = ?", $value);
	}

	public function filterByActive($value)
	{
		$this->getSelect()->where("active = 1");
	}
}