<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerAddresses extends \Zend_Db_Table
{
	protected $_name		= "customer_addresses";
	protected $_primary 	= "customer_address_id";

	protected $_referenceMap = array(
		"Customer" => array(
			"columns"				=> "customer_id",
			"refTableClass"		=> "DbTable\Customers",
			"refColumns"			=> "customer_id"
		),
		"State" => array(
			"columns"				=> "state_id",
			"refTableClass"		=> "DbTable\States",
			"refColumns"			=> "state_id"
		)
	);
}