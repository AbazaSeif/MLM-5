<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Group Entity
 *
 * @property string name
 * @property bool active
 */
class CustomerGroup extends \Application\Entity\Entity
{
	protected $_name;
	protected $_active;
}