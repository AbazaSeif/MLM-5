<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class EmployeePositions extends \Zend_Db_Table
{
	protected $_name 		= "employee_positions";
	protected $_primary	= "employee_position_id";

	protected $_dependenTables = array(
		"DbTable\Employees"
	);
}