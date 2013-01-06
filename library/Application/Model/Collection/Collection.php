<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Model\Collection;

/**
 * Collection
 */
class Collection implements \ArrayAccess, \IteratorAggregate, \Countable
{
	private $_collection = array();

	public function getCollection()
	{
		return $this->_collection;
	}

	public function setCollection(Collection $collection)
	{
		$this->_collection = $collection->getCollection();
	}

	public function fillCollection(array $data)
	{
		$this->_collection = $data;
	}

	public function clearCollection()
	{
		$this->_collection = array();
	}

	public function push($value)
	{
		$this->_collection[] = $value;
		return $this;
	}

	public function offsetExists($offset)
	{
		return isset($this->_collection[$offset]);
	}

	public function offsetGet($offset)
	{
		if (isset($this->_collection[$offset])) {
			return $this->_collection[$offset];
		}

		return null;
	}

	public function offsetSet($offset, $value)
	{
		$this->_collection[$offset] = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->_collection[$offset]);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->getCollection());
	}

	public function __call($method, $args)
	{
		$iterator = $this->getIterator();

		if (method_exists($iterator, $method)) {
			return call_user_func_array(array($iterator, $method), $args);
		}

		return null;
	}

	public function count()
	{
		return count($this->getCollection());
	}

	public static function toArray($collection)
	{
		$data = array();
		foreach ($collection as $row) {
			$data[] = $row->toArray();
		}

		return $data;
	}
}