<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer History Entity
 *
 * @property Customer customer
 * @property float date
 * @property string info
 */
class CustomerHistory extends \Application\Entity\Entity
{
	/**
	 * @var Customer
	 */
	protected $_customer;
	protected $_date;
	protected $_info;
}