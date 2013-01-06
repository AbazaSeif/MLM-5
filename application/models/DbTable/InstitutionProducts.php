<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class InstitutionProducts extends \Zend_Db_Table_Abstract
{
	protected $_name = "institution_products";
	protected $_primary = "institution_product_id";

	protected $_dependentTables = array(
		"DbTable\CustomerOldProducts"
	);

	protected $_referenceMap = array(
		"Institution" => array(
			"columns" 				=> "institution_id",
			"refTableClass" 	=> "DbTable\Institutions",
			"refColumns"			=> "institution_id"
		)
	);
}