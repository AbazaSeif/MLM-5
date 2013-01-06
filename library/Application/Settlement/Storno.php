<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Settlement;

use \Application\Settlement\Settlement;

class Storno extends Settlement
{
	protected $_parts = 2;

	public function settle()
	{
		$amount = $this->application->amount * $this->percent / 100;
		$amount = $amount * $this->getPercent() / 100;
		$amount = \Zend_Locale_Format::toNumber($amount, array("number_format" => "#0.00"));

		return $amount;
	}

	public function getPercent()
	{
		if (count($this->history) == 0) {
			return $this->_configuration['storno_first_part_percent'];
		} else {
			$prevSettlement = $this->history->current();
			if (date('d') - date('d', strtotime($prevSettlement->createDate)) >= $this->_configuration['storno_interval']) {
				return $this->_configuration['storno_second_part_percent'];
			} else {
				return 0;
			}
		}
	}
}