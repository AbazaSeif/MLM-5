<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class RenouncemenetDocuments extends \Zend_Db_Table
{
	protected $_name 		= "renouncemenet_documents";
	protected $_primary	= "renouncemenet_document_id";

	protected $_referenceMap = array(
		"Renouncemement" => array(
			"columns"				=> "renouncement_id",
			"refTableClass"		=> "DbTable\Renouncemenets",
			"refColumns"			=> "renoucnement_id"
		),
		"Document" => array (
			"columns" 				=> "document_id",
			"refTableClass"		=> "DbTable\Documents",
			"refColumns"			=> "document_id"
		)
	);
}