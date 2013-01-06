<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Employee Privilege Entity
 *
 * @property Employee employee
 * @property int module
 * @property int access
 */
class EmployeePrivilege extends \Application\Entity\Entity
{
	/**
	 * @var Employee
	 */
	protected $_employee;

	protected $_module;
	protected $_access;
}