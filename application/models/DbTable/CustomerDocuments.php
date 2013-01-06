<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerDocuments extends \Zend_Db_Table
{
	protected $_name		= "customer_documents";
	protected $_primary	= "customer_document_id";

	protected $_referenceMap = array(
		"Document" => array(
			"columns"				=> "document_id",
			"refTableClass"		=> "DbTable\Documents",
			"refColumns"			=> "document_id"
		),
		"Customer" => array(
			"columns"				=> "customer_id",
			"refTableClass" 	=> "DbTable\Customers",
			"refColumns"			=> "customer_id"
		)
	);
}