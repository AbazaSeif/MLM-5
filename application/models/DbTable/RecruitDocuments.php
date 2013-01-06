<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class RecruitDocuments extends \Zend_Db_Table_Abstract
{
	protected $_name 		= "recruit_documents";
	protected $_primary 	= "recruit_document_id";

	protected $_referenceMap = array(
		"Recruit" => array(
			"columns" 				=> "recruit_id",
			"refTableClass" 	=> "DbTable\Recruits",
			"refColumns" 		=> "recruit_id"
		),
		"Document" => array(
			"columns" 				=> "document_id",
			"refTableClass" 	=> "DbTable\Documents",
			"refColumns" 		=> "document_id"
		)
	);
}