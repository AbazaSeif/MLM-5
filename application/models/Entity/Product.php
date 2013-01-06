<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Product Entity
 *
 * @property Partner partner
 * @property string name
 * @property string description
 * @property bool active
 * @property bool deleted
 * @property Currency currency
 * @property SettlementType settlementType
 * @property ContactPerson contactPerson
 * @property ProductType type
 * @property float sellerPercent
 * @property ProductSettlementPercents[] percents
 * @property Customer[] customers
 */
class Product extends \Application\Entity\Entity
{
	/**
	* @var Partner
	*/
	protected $_partner;

	protected $_name;
	protected $_description;
	protected $_active;
	protected $_deleted;

	/**
	 * @var Currency
	 */
	protected $_currency;

	/**
	 * @var SettlementType
	 */
	protected $_settlementType;

	protected $_sellerPercent;

	/**
	 * @var ContactPerson
	 */
	protected $_contactPerson;

	/**
	 * @var ProductType
	 */
	protected $_type;

	/**
	 * @var ProductSettlementPercent[]
	 */
	protected $_percents;

	/**
	 * @var Customer[]
	 */
	protected $_customers;
}