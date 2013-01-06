<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerGroups extends \Zend_Db_Table
{
	protected $_name		= "customer_groups";
	protected $_primary	= "customer_group_id";

	protected $_dependentTables = array(
		"DbTable\Customers"
	);
}