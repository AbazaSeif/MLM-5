<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * @property Product product
 * @property EmployeePosition employeePosition
 * @property float value
 */
class ProductSettlementPercent extends \Application\Entity\Entity
{
	/**
	 * @var Product
	 */
	protected $_product;

	/**
	 * @var EmployeePosition
	 */
	protected $_employeePosition;

	protected $_value;
}