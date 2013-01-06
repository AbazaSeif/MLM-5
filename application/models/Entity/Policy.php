<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Policy Entity
 *
 * @property Application application
 * @property string outerNumber
 * @property date createDate
 * @property date endDate
 * @property string popPlace
 * @property date deliveryDate
 * @property date popReturnDate
 */
class Policy extends \Application\Entity\Entity
{
	/**
	 * @var Application
	 */
	protected $_application;
	protected $_outerNumber;
	protected $_createDate;
	protected $_endDate;
	protected $_popPlace;
	protected $_deliveryDate;
	protected $_popReturnDate;
}