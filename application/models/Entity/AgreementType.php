<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Agreement Type Entity
 *
 * @property string name
 * @property bool tax
 * @property bool active
 */
class AgreementType extends \Application\Entity\Entity
{
	protected $_name;
	protected $_tax;
	protected $_active;
}