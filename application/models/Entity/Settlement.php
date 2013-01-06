<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Settlement Entity
 *
 * @property Application application
 * @property Employee employee
 * @property SettlementTotal settlementTotal
 * @property string parts
 * @property float amount
 * @property date createDate
 */
class Settlement extends \Application\Entity\Entity
{
	/**
	 * @var Employee
	 */
	protected $_employee;

	/**
	 * @var Application
	 */
	protected $_application;

	/**
	 * @var SettlementTotal
	 */
	protected $_settlementTotal;

	protected $_parts;
	protected $_amount;
	protected $_createDate;
}