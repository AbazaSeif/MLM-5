<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DbTable;

class News extends \Zend_Db_Table
{
    protected $_name 		= "news";
    protected $_primary 	= "news_id";

    protected $_referenceMap = array(
        "Employee" => array(
            "columns"				=> "employee_id",
            "refTableClass"		    => "DbTable\Employees",
            "refColumns"			=> "employee_id"
        )
    );

    protected $_dependentTables = array(
        "DbTable\NewsGroups"
    );
}