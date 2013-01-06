<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Application Entity
 *
 * @property string innerNumber
 * @property string outerNumber
 * @property string description
 * @property ApplicationStatus status
 * @property Customer customer
 * @property Employee employee
 * @property Employee seller
 * @property Partner partner
 * @property Product product
 * @property float insuranceSum
 * @property PremiumType premiumType
 * @property float premium
 * @property float amount
 * @property bool alert
 * @property Currency currency
 * @property float currencyRate
 * @property date createDate
 * @property Shipment[] shipments
 * @property Document[] documents
 * @property string investmentTarget
 * @property date conclusionDateStart
 * @property date conclusionDateEnd
 * @property float margin
 * @property float costOfRepayment
 * @property bool settled
 * @property ApplicationPercent[] percents
 * @property Policy policy
 * @property ApplicationSettlement applicationSettlement
 */
class Application extends \Application\Entity\Entity
{
	protected $_innerNumber;
	protected $_outerNumber;
	protected $_description;

	/**
	 * @var ApplicationStatus
	 */
	protected $_status;

	/**
	 * @var Customer
	 */
	protected $_customer;

	/**
	 * @var Employee
	 */
	protected $_employee;

	/**
	 * @var Employee
	 */
	protected $_seller;

	/**
	 * @var Product
	 */
	protected $_product;

	/**
	 * @var Partner
	 */
	protected $_partner;

	protected $_insuranceSum;

	/**
	 * @var PremiumType
	 */
	protected $_premiumType;
	protected $_premium;
	protected $_amount;
	protected $_alert;

	/**
	 * @var SettlementType
	 */
	protected $_settlementType;

	/**
	 * @var Currency
	 */
	protected $_currency;
	protected $_currencyRate;
	protected $_createDate;

	/**
	 * @var Shipment[]
	 */
	protected $_shipments;

	/**
	 * @var Document[]
	 */
	protected $_documents;

	protected $_investmentTarget;
	protected $_conclusionDateStart;
	protected $_conclusionDateEnd;
	protected $_margin;
	protected $_costOfRepayment;
	protected $_settled;

	/**
	 * @var ApplicationPercent[]
	 */
	protected $_percents;

	/**
	 * @var Policy
	 */
	protected $_policy;

	/**
	 * @var ApplicationSettlement
	 */
	protected $_applicationSettlement;
}