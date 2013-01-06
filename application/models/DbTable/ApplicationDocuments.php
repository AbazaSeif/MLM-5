<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ApplicationDocuments extends \Zend_Db_Table
{
	protected $_name		= "application_documents";
	protected $_primary	= "application_document_id";

	protected $_referenceMap = array(
		"Application" => array(
			"columns"				=> "application_id",
			"refTableClass"		=> "DbTable\Applications",
			"refColumns"			=> "application_id"
		),
		"Document" => array(
			"columns"				=> "document_id",
			"refTableClass"		=> "DbTable\Documents",
			"refColumns"			=> "document_id"
		)
	);
}