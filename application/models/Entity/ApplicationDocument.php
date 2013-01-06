<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Customer Document Entity
 *
 * @property Application application
 * @property Document document
 */
class ApplicationDocument extends \Application\Entity\Entity
{
	/**
	 * @var Application
	 */
	protected $_application;

	/**
	 * @var Document
	 */
	protected $_document;
}