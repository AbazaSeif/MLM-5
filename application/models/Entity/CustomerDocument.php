<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Document Entity
 *
 * @property Customer customer
 * @property Document document
 */
class CustomerDocument extends \Application\Entity\Entity
{
	/**
	 * @var Customer
	 */
	protected $_customer;

	/**
	 * @var Document
	 */
	protected $_document;
}