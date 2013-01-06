<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class Institutions extends \Zend_Db_Table_Abstract
{
	protected $_name = "institutions";
	protected $_primary = "institution_id";

	protected $_dependentTables = array(
		"DbTable\CustomerOldProducts",
		"DbTable\InstitutionProducts"
	);
}