<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Currency extends \Zend_Db_Table
{
	protected $_name 		= "currency";
	protected $_primary 	= "currency_id";

	protected $_dependentTables = array(
		"DbTable\Products",
		"DbTable\Applications"
	);
}