<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Address Entity
 *
 * @property Customer customer
 * @property string street
 * @property string city
 * @property string postcode
 * @property State state
 * @property string houseNumber
 * @property string flatNumber
 * @property SHIPPING_ADDRESS|BILLING_ADDRESS addressType
 */
class CustomerAddress extends \Application\Entity\Entity
{
	const BILLING_ADDRESS = 0;
	const SHIPPING_ADDRESS = 1;

	/**
	 * @var Customer
	 */
	protected $_customer;

	protected $_street;
	protected $_city;
	protected $_postcode;

	/**
	 * @var State
	 */
	protected $_state;
	protected $_houseNumber;
	protected $_flatNumber;

	protected $_addressType;
}