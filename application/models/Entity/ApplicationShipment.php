<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Application Shipment Entity
 * @property Application application
 * @property Shipment shipment
 */
class ApplicationShipment extends \Application\Entity\Entity
{
	/**
	 * @var Application
	 */
	protected $_application;

	/**
	 * @var Shipment
	 */
	protected $_shipment;
}