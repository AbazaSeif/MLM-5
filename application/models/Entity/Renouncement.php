<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Renouncement Entity
 *
 * @property Customer customer
 * @property string policyNumber
 * @property date policyCreateDate
 * @property date documentSendDate
 * @property Shipment shipment
 * @property Document[] documents
 */
class Renouncement extends \Application\Entity\Entity
{
	protected $_customer;
	protected $_policyNumber;
	protected $_policyCreateDate;
	protected $_documentSendDate;

	/**
	 * @var Shipment
	 */
	protected $_shipment;

	/**
	 * @var Document[]
	 */
	protected $_documents;
}