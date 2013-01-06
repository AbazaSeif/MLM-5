<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Employee Entity
 *
 * @property string login
 * @property string password
 * @property string salt
 * @property string email
 * @property string phoneNumber
 * @property string cellPhoneNumber
 * @property date lastLogin
 * @property string firstname
 * @property string lastname
 * @property string description
 * @property Employee parentEmployee
 * @property bool active
 * @property bool deleted
 * @property AgreementType agreementType
 * @property string agreementNumber
 * @property date agreementStartDate
 * @property date agreementEndDate
 * @property date studentCardExpirationDate
 * @property string companyName
 * @property date birthDate
 * @property string birthCity
 * @property string motherName
 * @property string fatherName
 * @property string identityCard
 * @property string pesel
 * @property string nip
 * @property string regon
 * @property EmployeePosition position
 * @property string bankName
 * @property string bankAccount
 * @property date createDate
 * @property string recommendingPerson
 * @property EmployeeAddress[] addresses
 * @property EmployeePrivilege[] privileges
 * @property Document[] documents
 * @property Customers[] customers
 * @property EmployeeGroup group
 * @property EmployeeTraining[] trainings
 * @property string access
 */
class Employee extends \Application\Entity\Entity
{
	protected $_login;
	protected $_password;
	protected $_salt;
	protected $_email;
	protected $_phoneNumber;
	protected $_cellPhoneNumber;
	protected $_lastLogin;
	protected $_firstname;
	protected $_lastname;

	/**
	 * @var Employee
	 */
	protected $_parentEmployee;

	protected $_active;
	protected $_deleted;

	/**
	 * @var AgreementType
	 */
	protected $_agreementType;
	protected $_agreementNumber;
	protected $_agreementStartDate;
	protected $_agreementEndDate;
	protected $_companyName;
	protected $_studentCardExpirationDate;

	protected $_birthDate;
	protected $_birthCity;
	protected $_motherName;
	protected $_fatherName;
	protected $_identityCard;
	protected $_pesel;
	protected $_nip;
	protected $_regon;

	/**
	 * @var EmployeePosition
	 */
	protected $_position;

	protected $_bankName;
	protected $_bankAccount;
	protected $_createDate;
	protected $_recommendingPerson;

	/**
	 * @var EmployeeAddress[]
	 */
	protected $_addresses;

	/**
	 * @var EmployeePrivilege[]
	 */
	protected $_privileges;

	/**
	 * @var Document[]
	 */
	protected $_documents;

	/**
	 * @var Customers[]
	 */
	protected $_customers;

	/**
	 * @var EmployeeGroup
	 */
	protected $_group;

	/**
	 * @var EmployeeTraining[]
	 */
	protected $_trainings;

	/**
	 * @var string
	 */
	protected $_access;
}