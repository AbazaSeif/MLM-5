<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Policy extends \Zend_Db_Table
{
	protected $_name 		= "policy";
	protected $_primary 	= "policy_id";

	protected $_referenceMap = array(
		"Application" => array(
			"columns"				=> "application_id",
			"refTableClass"		=> "DbTable\Applications",
			"refColumns"			=> "application_id"
		),
	);
}