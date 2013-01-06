<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class ApplicationStatuses extends \Zend_Db_Table
{
	protected $_name		= "application_statuses";
	protected $_primary	= "application_status_id";

	protected $_dependentTables = array(
		"DbTable\Applicattions"
	);
}