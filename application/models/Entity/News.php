<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Agreement Type Entity
 *
 * @property string title
 * @property bool text
 * @property datetime createDate
 * @property bool active
 * @property Employee employee
 * @property EmployeeGroup[] groups
 * @property string attachment
 */
class News extends \Application\Entity\Entity
{
	protected $_title;
	protected $_text;
	protected $_createDate;
	protected $_active;
	protected $_employee;
	protected $_groups;
	protected $_attachment;
}