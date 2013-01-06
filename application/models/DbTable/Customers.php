<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Customers extends \Zend_Db_Table
{
	protected $_name 		= "customers";
	protected $_primary 	= "customer_id";

	protected $_dependentTables = array(
		"DbTable\CustomerAddresses",
		"DbTable\Applications",
		"DbTable\CustomerDocuments",
		"DbTable\Renouncements"
	);

	protected $_referenceMap = array(
		"Employee" => array(
			"columns" 				=> "employee_id",
			"refTableClass" 	=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"CustomerStatus" => array(
			"columns"				=> "customer_status_id",
			"refTableClass"		=> "DbTable\CustomerStatuses",
			"refColumns"			=> "customer_status_id"
		),
		"Group" => array(
			"columns"				=> "customer_group_id",
			"refTableClass"		=> "DbTable\CustomerGroups",
			"refColumns"			=> "customer_group_id"
		)
	);
}