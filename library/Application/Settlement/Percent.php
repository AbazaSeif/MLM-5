<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Settlement;

use Application\Settlement\Settlement;

class Percent extends Settlement
{
	protected $_parts = 1;

	public function settle()
	{
		$amount = $this->application->amount * $this->percent / 100;

		return $amount;
	}
}