<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Settlement Total Entity
 *
 * @property Employee employee
 * @property date createDate
 * @property float total
 * @property float tax
 */
class SettlementTotal extends \Application\Entity\Entity
{
	/**
	 * @var Employee
	 */
	protected $_employee;

	protected $_createDate;
	protected $_total;
	protected $_tax;
}