<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Entity;

/**
 * Entity
 *
 * @author Adrian Wądrzyk
 */
abstract class Entity
{
	protected $_identifier = 0;

	public function getIdentifier()
	{
		return $this->_identifier;
	}

	public function setIdentifier($id)
	{
		$this->_identifier = $id;
	}

	public function __get($key)
	{
		$property = '_' . $key;
		if (property_exists($this, $property)) {
			return $this->{$property};
		}

		return null;
	}

	public function __set($key, $value)
	{
		$property = '_' . $key;
		if (property_exists($this, $property)) {
			$this->{$property} = $value;
		}
	}

	public function toArray()
	{
		$results = array();
		$properties = get_object_vars($this);

		foreach ($properties as $property => $value) {
			if (!is_object($value)) {
				$key = str_replace('_', '', $property);
				$results[$key] = $value;
			}
		}

		return $results;
	}
}