<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class SettlementTypes extends \Zend_Db_Table
{
	protected $_name 		= "settlement_types";
	protected $_primary 	= "settlement_type_id";

	protected $_depenedentTables = array(
		"DbTable\Products",
		"DbTable\Applications"
	);
}