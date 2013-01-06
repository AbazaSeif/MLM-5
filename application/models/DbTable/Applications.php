<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Applications extends \Zend_Db_Table
{
	protected $_name 		= "applications";
	protected $_primary 	= "application_id";

	protected $_dependentTables = array(
		"DbTable\ApplicationPercents",
		"DbTable\Settlements",
		"DbTable\Policy",
		"DbTable\ApplicationSettlements"
	);

	protected $_referenceMap = array(
		"ApplicationStatus" => array(
			"columns"				=> "application_status_id",
			"refTableClass"		=> "DbTable\ApplicationStatuses",
			"refColumns"			=> "application_status_id"
		),
		"Customer" => array(
			"columns"				=> "customer_id",
			"refTableClass"		=> "DbTable\Customers",
			"refColumns"			=> "customer_id"
		),
		"Employee" => array(
			"columns"				=> "employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"Seller" => array(
			"columns"				=> "seller_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"Partner" => array(
			"columns"				=> "partner_id",
			"refTableClass"		=> "DbTable\Partners",
			"refColumns"			=> "partner_id"
		),
		"Product" => array(
			"columns"				=> "product_id",
			"refTableClass"		=> "DbTable\Products",
			"refColumns"			=> "product_id"
		),
		"PremiumType"	=> array(
			"columns"				=> "premium_type_id",
			"refTableClass"		=> "DbTable\PremiumTypes",
			"redColumns"		=> "premium_type_id"
		),
		"SettlementType" => array(
			"columns"				=> "settlement_type_id",
			"refTableClass"		=> "DbTable\SettlementTypes",
			"refColumns"			=> "settlement_type_id"
		),
		"Shipment" => array(
			"columns" 				=> "shipment_id",
			"refTableClass"		=> "DbTable\Shipments",
			"refColumns"			=> "shipment_id"
		),
		"Currency" => array(
			"columns"				=> "currencyId",
			"refTableClass"		=> "DbTable\Currency",
			"refColumns"			=> "currency_id"
		)
	);
}