<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Instructions extends \Zend_Db_Table_Abstract
{
	protected $_name = "instructions";
	protected $_primary = "instruction_id";

	protected $_dependentTables = array(
		"DbTable\CustomerOldProducts"
	);
}