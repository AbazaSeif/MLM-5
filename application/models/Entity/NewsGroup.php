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
 * @property News news
 * @property EmployeeGroup group
 */
class NewsGroup extends \Application\Entity\Entity
{
	protected $_group;
	protected $_news;
}