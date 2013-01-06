<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Settlement;

use \Application\Settlement\Settlement;

class Incaso extends Settlement
{
	public function settle()
	{
		$amount = $this->application->amount * $this->percent / 100;
		$amount /= $this->countParts($this->application->premiumType);
		$amount = \Zend_Locale_Format::toNumber($amount, array("number_format" => "#0.00"));

		return $amount;
	}

	public function countParts(\Model\PremiumType $premiumType)
	{
		$this->_parts = $this->_configuration['incaso_parts'] / $premiumType->periodInMonths;
		return $this->_parts;
	}
}