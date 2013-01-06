<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class EmployeeGroups extends \Zend_Db_Table
{
	protected $_name 		= "employee_groups";
	protected $_primary 	= "employee_group_id";

	protected $_dependentTables = array(
		"DbTable\Employees",
		"\DbTable\ProductSettlementPercents"
	);
}