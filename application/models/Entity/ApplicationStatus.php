<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Application Status Entity
 *
 * @property string name
 * @property bool active
 * @property bool takenToSettle
 */
class ApplicationStatus extends \Application\Entity\Entity
{
	protected $_name;
	protected $_active;
	protected $_takenToSettle;
}