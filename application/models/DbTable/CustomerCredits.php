<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerCredits extends \Zend_Db_Table_Abstract
{
	protected $_name = "customer_credits";
	protected $_primary = "customer_credit_id";

	protected $_referenceMap = array(
		"Customer" => array(
			"columns" 				=> "customer_id",
			"refTableClass" 	=> "DbTable\Customers",
			"refColumns"			=> "customer_id"
		),
		"Credit" => array(
			"columns"				=> "credit_type_id",
			"refTableClass" 	=> "DbTable\CreditTypes",
			"refcolumns"			=> "credit_type_id"
		),
		"Currency" => array(
			"columns"				=> "currency_id",
			"refTableClass"		=> "DbTable\Currency",
			"refColumns"			=> "currency_id"
		)
	);
}