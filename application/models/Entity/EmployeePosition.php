<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Employee Postion Entity
 *
 * @property string name
 * @property bool active
 * @property bool potencial
 */
class EmployeePosition extends \Application\Entity\Entity
{
	protected $_name;
	protected $_active;
	protected $_potencial;
}