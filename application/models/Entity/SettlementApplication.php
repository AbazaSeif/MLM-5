<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Settlement Application Entity
 *
 * @property Settlement settlement
 * @property Application application
 * @property float amount
 */
class SettlementApplication extends \Application\Entity\Entity
{
	/**
	 * @var Settlement
	 */
	protected $_settlement;

	/**
	 * @var Application
	 */
	protected $_application;

	protected $_amount;
}