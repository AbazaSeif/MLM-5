<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ShipmentTypes extends \Zend_Db_Table
{
	protected $_name		= "shipment_types";
	protected $_primary 	= "shipment_type_id";

	protected $_dependentTables = array(
		"DbTable\Shipments"
	);
}