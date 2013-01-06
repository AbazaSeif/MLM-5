<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Documents extends \Zend_Db_Table
{
	protected $_name 		= "documents";
	protected $_primary 	= "document_id";

	protected $_dependentTables = array(
		"DbTable\ApplicationDocuments",
		"DbTable\CustomerDocuments",
		"DbTable\EmployeeDocuments",
		"DbTable\RecruitDocuments"
	);
}