<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class SettlementApplications extends \Zend_Db_Table
{
	protected $_name		= "settlement_applications";
	protected $_primary	= "settlement_application_id";

	protected $_referenceMap = array(
		"Settlement" => array(
			"columns"				=> "settlement_id",
			"refTableClass"		=> "DbTable\Settlements",
			"refColumns"			=> "settlement_id"
		),
		"Application" => array(
			"columns"				=> "application_id",
			"refTableClass"		=> "DbTable\Applications",
			"refColumns"			=> "application_id"
		)
	);
}