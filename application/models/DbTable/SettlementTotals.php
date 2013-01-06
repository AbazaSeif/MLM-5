<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class SettlementTotals  extends \Zend_Db_Table
{
	protected $_name = "settlement_totals";
	protected $_primary = "settlement_total_id";

	protected $_dependentTables = array(
		"DbTable\SettlementTotals"
	);

	protected $_referenceMap = array(
		"Employee" => array(
			"columns" 				=> "employee_id",
			"refTableClass" 	=> "\DbTable\Employees",
			"refColumns" 		=> "employee_id"
		)
	);
}