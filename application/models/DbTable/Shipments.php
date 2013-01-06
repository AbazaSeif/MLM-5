<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Shipments extends \Zend_Db_Table
{
	protected $_name 		= "shipments";
	protected $_primary	= "shipment_id";

	protected $_depenendetTables = array(
		"DbTable\Applications"
	);
}