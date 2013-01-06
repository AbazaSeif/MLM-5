<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Credit Entity
 *
 * @property Customer customer
 * @property CreditType type
 * @property string bank
 * @property float amount
 * @property Currency currency
 * @property float currencyRate
 * @property float installment
 * @property date conclusionDateStart
 * @property int periodInMonths
 * @property float balance
 * @property float balanceDate
 * @property float margin
 * @property float rrso
 * @property float costOfRepayment
 */
class CustomerCredit extends \Application\Entity\Entity
{
	/**
	 * @var Customer
	 */
	protected $_customer;

	/**
	 * @var CreditType
	 */
	protected $_type;
	protected $_bank;
	protected $_margin;
	protected $_rrso;
	protected $_amount;

	/**
	 * @var Currency
	 */
	protected $_currency;
	protected $_currencyRate;
	protected $_installment;
	protected $_conclusionDateStart;
	protected $_periodInMonths;
	protected $_balance;
	protected $_balanceDate;
	protected $_costOfRepayment;
}