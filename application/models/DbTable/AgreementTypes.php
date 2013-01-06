<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class AgreementTypes extends \Zend_Db_Table
{
	protected $_name 		= "agreement_types";
	protected $_primary 	= "agreement_type_id";

	protected $_dependentTables = array(
		"DbTable\Employees"
	);
}