<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Partner Entity
 *
 * @property string name
 * @property string description
 * @property bool active
 * @property bool deleted
 * @property ContactPerson contactPerson
 * @property Product[] products
 */
class Partner extends \Application\Entity\Entity
{
	protected $_name;
	protected $_description;
	protected $_active;
	protected $_deleted;

	/**
	 * @var ContactPerson
	 */
	protected $_contactPerson;

	/**
	 * @var Product[]
	 */
	protected $_products;
}