<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Employee Group Entity
 *
 * @property string name
 * @property bool active
 */
class EmployeeGroup extends \Application\Entity\Entity
{
	protected $_name;
	protected $_active;
}