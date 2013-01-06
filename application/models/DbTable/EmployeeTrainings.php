<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class EmployeeTrainings extends \Zend_Db_Table_Abstract
{
	protected $_name = "employee_trainings";
	protected $_primary = "employee_training_id";

	protected $_referenceMap = array(
		"Trainig" => array(
			"columns" 				=> "training_id",
			"refTableClass" 	=> "DbTable\Trainings",
			"refColumns"			=> "trainig_id"
		),
		"Employee" => array(
			"columns" 				=> "employee_id",
			"refTableClass" 	=> "DbTable\Employees",
			"refColumns" 		=> "employee_id"
		),
		"Examiner" => array(
			"columns" 				=> "examiner_id",
			"refTableClass" 	=> "DbTable\Employees",
			"refColumns" 		=> "employee_id"
		)
	);
}