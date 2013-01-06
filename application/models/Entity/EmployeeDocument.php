<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Employee Document entity
 *
 * @property Employee employee
 * @property Document document
 */
class EmployeeDocument extends \Application\Entity\Entity
{
	/**
	 * @var Employee
	 */
	protected $_employee;

	/**
	 * @var Document
	 */
	protected $_document;
}