<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Recruit Entity
 *
 * @property string email
 * @property string phoneNumber
 * @property string firstname
 * @property string lastname
 * @property string description
 * @property Employee parentEmployee
 * @property bool active
 * @property bool deleted
 * @property EmployeePosition position
 * @property date createDate
 * @property string recommendingPerson
 * @property Document[] documents
 * @property Employee verifier
 */
class Recruit extends \Application\Entity\Entity
{
	protected $_email;
	protected $_phoneNumber;
	protected $_firstname;
	protected $_lastname;

	/**
	 * @var Employee
	 */
	protected $_parentEmployee;

	protected $_active;
	protected $_deleted;

	/**
	 * @var EmployeePosition
	 */
	protected $_position;

	protected $_createDate;
	protected $_recommendingPerson;

	/**
	 * @var Document[]
	 */
	protected $_documents;

	/**
	 * @var Employee
	 * @var unknown_type
	 */
	protected $_verifier;
}