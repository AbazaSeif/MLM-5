<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ApplicationShipments extends \Zend_Db_Table_Abstract
{
	protected $_name = "application_shipments";
	protected $_primary = "application_shipment_id";

	protected $_referenceMap = array(
		"Application" => array(
			"columns" 				=> "application_id",
			"refTableClass" 	=> "DbTable\Applications",
			"refColumns" 		=> "application_id"
		),
		"Shipment" => array(
			"columns" 				=> "shipment_id",
			"refTableClass" 	=> "DbTable\Shipments",
			"refColumns" 		=> "shipment_id"
		)
	);
}