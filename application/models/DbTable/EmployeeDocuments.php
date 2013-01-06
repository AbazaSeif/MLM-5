<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class EmployeeDocuments extends \Zend_Db_Table
{
	protected $_name 		= "employee_documents";
	protected $_primary 	= "employee_document_id";

	protected $_referenceMap = array(
		"Employee" => array(
			"columns"				=> "employee_id",
			"refTableClass"		=> "DbTable\Employees",
			"refColumns"			=> "employee_id"
		),
		"Document"	=> array(
			"columns"				=> "document_id",
			"refTableClass"		=> "DbTable\Documents",
			"refColumns"			=> "document_id"
		)
	);
}