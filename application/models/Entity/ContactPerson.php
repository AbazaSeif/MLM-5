<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Contact Person Entity
 *
 * @property string firstname
 * @property string lastname
 * @property string street
 * @property string city
 * @property string postcode
 * @property State state
 * @property string phoneNumber
 * @property string email
 * @property string position
 * @property bool active
 * @property Partner[] partners
 * @property Product[] products
 */
class ContactPerson extends \Application\Entity\Entity
{
	protected $_firstname;
	protected $_lastname;
	protected $_street;
	protected $_city;
	protected $_postcode;

	/**
	 * @var State
	 */
	protected $_state;

	protected $_phoneNumber;
	protected $_email;
	protected $_position;
	protected $_active;

	/**
	 * @var Partner[]
	 */
	protected $_partners;

	/**
	 * @var Product[]
	 */
	protected $_products;
}