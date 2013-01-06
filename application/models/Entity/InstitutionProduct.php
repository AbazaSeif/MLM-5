<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Institution Entity
 *
 * @property Institution institution
 * @property string name
 * @property bool active
 * @property bool deleted
 */
class InstitutionProduct extends \Application\Entity\Entity
{
	/**
	 * @var Institution
	 */
	protected $_institution;

	protected $_name;
	protected $_active;
	protected $_deleted;
}