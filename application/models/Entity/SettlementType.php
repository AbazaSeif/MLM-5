<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Settlement Type Entity
 *
 * @property string name
 * @property int active
 * @property string engine;
 */
class SettlementType extends \Application\Entity\Entity
{
	protected $_name;
	protected $_active;
	protected $_engine;
}