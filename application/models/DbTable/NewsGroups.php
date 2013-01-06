<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class NewsGroups extends \Zend_Db_Table
{
	protected $_name 		= "news_groups";
	protected $_primary 	= "news_group_id";

	protected $_referenceMap = array(
		"EmployeeGroups" => array(
			"columns"				=> "employee_group_id",
			"refTableClass"		    => "DbTable\EmployeesGroups",
			"refColumns"			=> "employee_group_id"
		),
        "News" => array(
            "columns"				=> "news_id",
            "refTableClass"		    => "DbTable\News",
            "refColumns"			=> "news_id"
        )
	);
}