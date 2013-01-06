<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class States extends \Zend_Db_Table
{
	protected $_name		= "states";
	protected $_primary	= "state_id";

	protected $_dependentTables = array(
		"DbTable\CustomerAddresses",
		"DbTable\EmployeeAddresses"
	);
}