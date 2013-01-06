<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Old Product Entity
 *
 * @property Customer customer
 * @property Institution institution
 * @property Instruction instruction
 * @property float insuranceSum
 * @property float insuranceSumNnw
 * @property float insuranceSumNkw
 * @property date conclusionDateStart
 * @property date conclusionDateEnd
 * @property float fee
 * @property PremiumType premiumType
 * @property float contribution
 * @property float amount
 * @property date productCreateDate
 * @property string policyNumber
 * @property string description
 * @property InstitutionProduct institutionProduct
 */
class CustomerOldProduct extends \Application\Entity\Entity
{
	/**
	 * @var Customer
	 */
	protected $_customer;

	/**
	 * @var Institution
	 */
	protected $_institution;

	/**
	 * @var InstitutionProduct
	 */
	protected $_institutionProduct;

	/**
	 * @var Instruction
	 */
	protected $_instruction;

	protected $_insuranceSum;
	protected $_insuranceSumNnw;
	protected $_insuranceSumNkw;
	protected $_conclusionDateStart;
	protected $_conclusionDateEnd;
	protected $_fee;

	/**
	 * @var PremiumType
	 */
	protected $_premiumType;

	protected $_contribution;
	protected $_amount;
	protected $_productCreateDate;
	protected $_policyNumber;
	protected $_description;
}