<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ContactPersons extends \Zend_Db_Table
{
	protected $_name 		= "contact_persons";
	protected $_primary 	= "contact_person_id";

	protected $_dependentTables = array(
		"DbTable\Partners",
		"DbTable\Products"
	);
}