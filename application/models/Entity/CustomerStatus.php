<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Status Entity
 *
 * @property string name
 * @property bool active
 */
class CustomerStatus extends \Application\Entity\Entity
{
	protected $_name;
	protected $_active;
}