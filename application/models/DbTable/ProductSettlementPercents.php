<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ProductSettlementPercents extends \Zend_Db_Table_Abstract
{
	protected $_name = "product_settlement_percents";
	protected $_primary = "product_settlement_percent_id";

	protected $_referenceMap = array(
		"Product" => array(
			"columns" 				=> "product_id",
			"refTableClass" 	=> "DbTable\Products",
			"refColumns" 		=> "product_id"
		),
		"EmployeeGroup" => array(
			"columns" 				=> "employee_position_id",
			"refTableClass" 	=> "DbTable\EmployeePositions",
			"refColumns" 		=> "employee_position_id"
		)
	);
}