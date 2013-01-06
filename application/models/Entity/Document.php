<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Document Entity
 *
 * @property string name
 * @property string type
 * @property string path
 * @property date createDate
 * @property Employee employee
 */
class Document extends \Application\Entity\Entity
{
	protected $_name;
	protected $_type;
	protected $_path;
	protected $_createDate;

	/**
	 * @var Employee
	 */
	protected $_employee;
}