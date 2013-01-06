<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Settlement;

use Application\Settlement\Settlement;

class Classic extends Settlement
{
	public function settle()
	{
		$amount = $this->percent;
		$amount = \Zend_Locale_Format::toNumber($amount, array("number_format" => "#0.00"));

		return $amount;
	}
}