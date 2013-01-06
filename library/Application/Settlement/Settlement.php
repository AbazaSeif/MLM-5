<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Settlement;

use Application\Entity\EntityManager;

use Application\Settlement\Settlementable;

/**
 * Settlement strategy abstract class
 * @property Application application
 * @property Employee employee
 * @property Settlement[] history
 * @property floar percent;
 * @property int parts
 */
abstract class Settlement implements Settlementable
{
	/**
	 * @var Application
	 */
	protected $_application;

	/**
	 * @var Employee
	 */
	protected $_employee;

	/**
	 * @var Settlement[]
	 */
	protected $_history;

	protected $_percent;

	protected $_configuration;

	protected $_parts = 1;

	public function __get($key)
	{
		return $this->{"_" . $key};
	}

	public function __set($key, $value)
	{
		$this->{"_" . $key} = $value;
	}

	public function getParts()
	{
		return $this->_parts;
	}
}