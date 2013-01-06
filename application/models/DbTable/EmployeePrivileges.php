<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class EmployeePrivileges extends \Zend_Db_Table
{
	protected $_name 		= "employee_privileges";
	protected $_primary 	= "employee_privilege_id";

	protected $_referenceMap = array(
		"Employee" => array(
			"columns"				=> "employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		)
	);
}