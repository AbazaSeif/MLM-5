<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Settlements extends \Zend_Db_Table
{
	protected $_name 		= "settlements";
	protected $_primary	= "settlement_id";

	protected $_depenedentTabels = array(
		"DbTable\SettlementApplications"
	);

	protected $_referenceMap = array(
		"Employee" => array(
			"columns"				=> "employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"Total" => array(
			"columns"				=> "settlement_total_id",
			"refTableClass"		=> "\DbTable\SettlementTotals",
			"refColumns"			=> "settlement_total_id"
		)
	);
}