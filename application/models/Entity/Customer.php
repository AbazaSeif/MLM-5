<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Entity
 *
 * @property string firstname
 * @property string lastname
 * @property string email
 * @property string phoneNumber
 * @property string cellPhoneNumber
 * @property M|K male
 * @property date birthDate
 * @property string birthCity
 * @property string identityCard
 * @property string pesel
 * @property string nip
 * @property string regon
 * @property Employee employee
 * @property CustomerHistory history
 * @property CustomerStatus status
 * @property string recommendingPerson
 * @property date dateOfLastAnalysis;
 * @property string numberOfLastAnalysis;
 * @property date createDate
 * @property bool active
 * @property bool deleted
 * @property string phoneNumber
 * @property CustomerAddress[] addresses
 * @property Document[] documents
 * @property Product[] products
 * @property CustomerGroup group
 * @property OldProduct[] oldProducts
 * @property CustomerCredit[] credits
 * @property Renouncement[] renouncements
 */
class Customer extends \Application\Entity\Entity
{
	const MALE 		= 'M';
	const FEMALE	= 'K';

	protected $_firstname;
	protected $_lastname;
	protected $_email;
	protected $_male;
	protected $_birthDate;
	protected $_birthCity;
	protected $_identityCard;
	protected $_pesel;
	protected $_nip;
	protected $_regon;
	protected $_history;

	/**
	 * @var Employee
	 */
	protected $_employee;

	/**
	 * @var CustomerStatus
	 */
	protected $_status;

	protected $_recommendingPerson;
	protected $_dateOfLastAnalysis;
	protected $_numberOfLastAnalysis;
	protected $_createDate;
	protected $_active;
	protected $_phoneNumber;
	protected $_cellPhoneNumber;
	protected $_deleted;

	/**
	 * @var CustomerAddress[]
	 */
	protected $_addresses;

	/**
	 * @var Document[]
	 */
	protected $_documents;

	/**
	 * @var Product[]
	 */
	protected $_products;

	/**
	 * @var CustomerGroup
	 */
	protected $_group;

	/**
	 * @var OldProduct[]
	 */
	protected $_oldProducts;

	/**
	 * @var CustomerCredit[]
	 */
	protected $_credits;

	/**
	 * @var Renouncement[]
	 */
	protected $_renouncements;
}