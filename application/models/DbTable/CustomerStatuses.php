<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerStatuses extends \Zend_Db_Table
{
	protected $_name 		= "customer_statuses";
	protected $_primary	= "customer_status_id";

	protected $_dependenttables = array(
		"DbTable\Customers"
	);
}