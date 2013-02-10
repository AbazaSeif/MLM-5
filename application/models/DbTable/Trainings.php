<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Trainings extends \Zend_Db_Table_Abstract
{
	protected $_name = "trainings";
	protected $_primary = "training_id";

	protected $_dependentTables = array(
		"DbTable\EmployeeTrainigs"
	);

	protected $_referenceMap = array(
	    "Employee" => array(
	        "columns"				=> "employee_id",
	        "refTableClass"		=> "DbTable\Employees",
	        "refColumns"			=> "employee_id"
	    )
    );
}