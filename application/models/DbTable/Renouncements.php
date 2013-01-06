<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Renouncements extends \Zend_Db_Table
{
	protected $_name		= "renouncements";
	protected $_primary 	= "renouncement_id";

	protected $_referenceMap = array(
		"Customer" => array(
			"columns" 				=> "customer_id",
			"refTableClass"		=> "DbTable\Customers",
			"refColumns"			=> "customer_id"
		),
		"Shipment" => array(
			"columns"				=> "shipment_id",
			"refTableClass"		=> "DbTable\Shipments",
			"refColumns"			=> "shipment_id"
		)
	);
}