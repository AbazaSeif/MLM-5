<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Premium Type Entity
 *
 * @property string name
 * @property int periodInMonths
 * @property bool active
 */
class PremiumType extends \Application\Entity\Entity
{
	protected $_name;
	protected $_periodInMonths;
	protected $_active;
}