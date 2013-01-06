<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Recruits extends \Zend_Db_Table
{
	protected $_name 		= "recruits";
	protected $_primary 	= "recruit_id";

	protected $_dependentTables = array(
		"DbTable\RecruitDocuments"
	);

	protected $_referenceMap = array(
		"Parent" => array(
			"columns"				=> "parent_employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"Position" => array(
			"columns" 				=> "position_id",
			"refTableClass"		=> "DbTable\Positions",
			"refColumns"			=> "position_id"
		)
	);
}