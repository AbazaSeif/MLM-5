<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Currency Entity
 *
 * @property string name
 * @property float rate
 * @property bool active
 * @property bool deleted
 */
class Currency extends \Application\Entity\Entity
{
	protected $_name;
	protected $_rate;
	protected $_active;
	protected $_deleted;
}