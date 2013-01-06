<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class EmployeeAddresses extends \Zend_Db_Table
{
	protected $_name 		= "employee_addresses";
	protected $_primary 	= "employee_address_id";

	protected $_referenceMap = array(
		"Employee" => array(
			"columns" 				=> "employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"State" => array(
			"columns"				=> "state_id",
			"refTableClass"		=> "DbTable\States",
			"refColumns"			=> "state_id"
		)
	);
}