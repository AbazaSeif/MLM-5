<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class PremiumTypes extends \Zend_Db_Table
{
	protected $_name		= "premium_types";
	protected $_primary	= "premium_type_id";

	protected $_dependentTables = array(
		"DbTable\Applications"
	);
}