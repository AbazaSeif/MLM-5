<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Form;

class Tab
{
	private $_attr = array("class" => "additional-tab");
	private $_name;
	private $_legend;
	private $_partial;

	public function __construct($name, $legend, $partial)
	{
		$this->_name = $name;
		$this->_legend = $legend;
		$this->_partial = $partial;
	}

	public function getAttrib($key)
	{
		if (isset($this->_attr[$key])) {
			return $this->_attr[$key];
		}

		return null;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getLegend()
	{
		return $this->_legend;
	}

	public function getPartial()
	{
		return $this->_partial;
	}
}