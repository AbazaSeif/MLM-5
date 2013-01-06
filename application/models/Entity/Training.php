<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * @property string title
 * @property string description
 * @property bool active
 */
class Training extends \Application\Entity\Entity
{
	protected $_title;
	protected $_description;
	protected $_active;
}