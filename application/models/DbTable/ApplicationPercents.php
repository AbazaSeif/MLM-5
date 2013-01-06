<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ApplicationPercents extends \Zend_Db_Table_Abstract
{
	protected $_name = "application_percents";
	protected $_primary = "application_percent_id";

	protected $_referenceMap = array(
		"Application" => array(
			"columns" 				=> "application_id",
			"refTableClass" 	=> "DbTable\Applications",
			"refColumns" 		=> "application_id"
		),
		"Employee" => array(
			"columns" 				=> "employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		)
	);
}