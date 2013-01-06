<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Configuration Entity
 *
 * @property float taxFreeAllowance
 * @property float taxPercent
 * @property int incasoParts
 * @property float stornoFirstPartPercent
 * @property float stornoSecondPartPercent
 */
class Configuration extends \Application\Entity\Entity
{
	protected $_taxFreeAllowance;
	protected $_taxPercent;
	protected $_incasoParts;
	protected $_stornoInterval;
	protected $_stornoFirstPartPercent;
	protected $_stornoSecondPartPercent;
}