<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ProductTypes extends \Zend_Db_Table
{
	protected $_name 		= "product_types";
	protected $_primary 	= "product_type_id";

	protected $_dependentTables = array(
		"DbTable\Products"
	);
}