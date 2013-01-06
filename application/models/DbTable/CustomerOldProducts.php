<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerOldProducts extends \Zend_Db_Table_Abstract
{
	protected $_name = "customer_old_products";
	protected $_primary = "customer_old_product_id";

	protected $_referenceMap = array(
		"Customer" => array(
			"columns" 				=> "customer_id",
			"refTableClass" 		=> "DbTable\Customers",
			"refColumns"	 		=> "customer_id"
		),
		"Institution" => array(
			"columns" 				=> "institution_id",
			"refTableClass" 		=> "DbTable\Institutions",
			"refColumns"			=> "institution_id"
		),
		"PremiumType" => array(
			"columns" 				=> "premium_type_id",
			"refTableClass"			=> "DbTable\PremiumTypes",
			"refColumns"			=> "premium_type_id"
		)
	);
}