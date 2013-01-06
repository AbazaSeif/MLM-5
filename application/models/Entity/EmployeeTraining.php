<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * @property Employee employee
 * @property Training training
 * @property date createDate
 * @property float mark
 * @property Employee examiner
 */
class EmployeeTraining extends \Application\Entity\Entity
{
	/**
	 * @var Employee
	 */
	protected $_employee;

	/**
	 * @var Training
	 */
	protected $_training;
	protected $_createDate;
	protected $_mark;

	/**
	 * @var Employee
	 */
	protected $_examiner;
}