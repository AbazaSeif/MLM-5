<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Shipment Entity
 *
 * @property ShipmentType type
 * @property date createDate
 * @property string street
 * @property string city
 * @property string postcode
 * @property State state
 * @property string phoneNumber
 * @property string email
 */
class Shipment extends \Application\Entity\Entity
{
	/**
	 * @var ShipmentType
	 */
	protected $_type;

	protected $_createDate;
	protected $_street;
	protected $_city;
	protected $_postcode;

	/**
	 * @var State
	 */
	protected $_state;

	protected $_phoneNumber;
	protected $_email;
}