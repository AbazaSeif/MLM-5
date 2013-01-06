<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Application Settlement Entity
 *
 * @property Application application
 * @property float sellerPercent
 * @property array configuration
 */
class ApplicationSettlement extends \Application\Entity\Entity
{
	/**
	 * @var Application
	 */
	protected $_application;

	protected $_sellerPercent;
	protected $_configuration;
}