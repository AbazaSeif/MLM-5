<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Model\Collection;

/**
 * Virtual Collection
 */
class VirtualCollection extends Collection implements \Application\Proxy\Proxy
{
	private $_callable;

	public function __construct($callable)
	{
		$this->_callable = $callable;
	}

	public function load($page = null, $limit = null)
	{
		$collection = parent::getCollection();
		if (empty($collection)) {
			$data = call_user_func_array($this->_callable, func_get_args());
			parent::fillCollection($data);
		}
	}

	public function getCollection()
	{
		$this->load();
		return parent::getCollection();
	}

	public function push($value)
	{
		$this->load();
		return parent::push($value);
	}

	public function offsetExists($offset)
	{
		$this->load();
		return parent::offsetExists($offset);
	}

	public function offsetGet($offset)
	{
		$this->load();
		return parent::offsetGet($offset);
	}

	public function offsetSet($offset, $value)
	{
		$this->load();
		parent::offsetSet($offset, $value);
	}

	public function offsetUnset($offset)
	{
		$this->load();
		parent::offsetUnset($offset);
	}
}