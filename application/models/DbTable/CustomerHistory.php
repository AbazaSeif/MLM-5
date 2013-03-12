<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class CustomerHistory extends \Zend_Db_Table_Abstract
{
	protected $_name = "customer_history";
	protected $_primary = "customer_history_id";

	protected $_referenceMap = array(
		"Customer" => array(
			"columns" 				=> "customer_id",
			"refTableClass" 	=> "DbTable\Customers",
			"refColumns"			=> "customer_id"
		),
	    "Instruction" => array(
	        "columns" 				=> "instruction_id",
	        "refTableClass" 		=> "DbTable\Instructions",
	        "refColumns"			=> "instruction_id"
	    ),
	);
}