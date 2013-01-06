<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Employees extends \Zend_Db_Table
{
	protected $_name 		= "employees";
	protected $_primary 	= "employee_id";

	protected $_dependentTables = array(
		"DbTable\Employees",
		"DbTable\EmployeeAddresses",
		"DbTable\EmployeePrivileges",
		"DbTable\Customers",
		"DbTable\Applications",
		"DbTable\ApplicationPercents",
		"DbTable\Settlements"
	);

	protected $_referenceMap = array(
		"Parent" => array(
			"columns"				=> "parent_employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"ArragmentType" => array(
			"columns"				=> "arragment_type_id",
			"refTableClass"		=> "DbTable\ArragmentTypes",
			"refColumns"			=> "arragment_type_id"
		),
		"Position" => array(
			"columns" 				=> "position_id",
			"refTableClass"		=> "DbTable\Positions",
			"refColumns"			=> "position_id"
		),
		"Group"	=> array(
			"columns"				=> "employee_group_id",
			"refTableClass"		=> "DbTable\EmployeeGroups",
			"refColumns"			=> "employee_group_id"
		)
	);
}