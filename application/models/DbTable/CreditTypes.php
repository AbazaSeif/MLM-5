<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CreditTypes extends \Zend_Db_Table_Abstract
{
	protected $_name = "credit_types";
	protected $_primary = "credit_type_id";

	protected $_dependentTables = array(
		"DbTable\CustomerCredits"
	);
}