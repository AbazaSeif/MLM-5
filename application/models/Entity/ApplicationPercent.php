<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Application Percent Entity
 *
 * @property Application application
 * @property Employee employee
 * @property float percent
 */
class ApplicationPercent extends \Application\Entity\Entity
{
	/**
	 * @var Application
	 */
	protected $_application;

	/**
	 * @var Employee
	 */
	protected $_employee;

	protected $_percent;

	protected $_forSeller;
}