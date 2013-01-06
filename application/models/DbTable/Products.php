<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Products extends \Zend_Db_Table
{
	protected $_name 		= "products";
	protected $_primary	= "product_id";

	protected $_depenedentTables = array(
		"DbTable\Applications",
		"DbTable\ProductSettlementPercents"
	);

	protected $_referenceMap = array(
		"Partner" => array(
			"columns" 				=> "partner_id",
			"refTableClass"		=> "DbTable\Partners",
			"refColumns"			=> "partner_id"
		),
		"Currency"	 => array(
			"columns"				=> "currency_id",
			"refTableClass"		=> "DbTable\Currency",
			"refColumns"			=> "currency_id"
		),
		"SettlementType" => array(
			"columns"				=> "settlement_type_id",
			"refTableClass"		=> "DbTable\SettlementTypes",
			"refColumns"			=> "settlement_type_id"
		),
		"ContactPerson" => array(
			"columns" 				=> "contact_person_id",
			"refTableClass" 	=> "DbTable\ContactPersons",
			"refColumns"			=> "contact_person_id"
		),
		"Renouncement" => array(
			"columns"				=> "renouncemenet_id",
			"refTableClass"		=> "DbTable\Renouncemenets",
			"refColumns"			=> "renouncement_id"
		),
		"ProductType" => array (
			"columns"				=> "product_type_id",
			"refTableClass"		=> "DbTable\ProductTypes",
			"refColumns"			=> "product_type_id"
		)
	);
}