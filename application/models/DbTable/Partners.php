<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Partners extends \Zend_Db_Table
{
	protected $_name 		= "partners";
	protected $_primary	= "partner_id";

	protected $_depenedentTables = array(
		"DbTable\Products"
	);

	protected $_referenceMap = array(
		"ContactPerson" => array(
			"columns" 				=> "contact_person_id",
			"refTableClass" 	=> "DbTable\ContactPersons",
			"refColumns"			=> "contact_person_id"
		)
	);
}