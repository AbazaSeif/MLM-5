<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Settlement;

class Factory
{
	const CLASSIC 	= 'classic';
	const INCASO 		= 'incaso';
	const STORNO 	= 'storno';
	const PERCENT 	= 'percent';

	private static $_instances = array();

	public static function factory($type)
	{
		if (!isset(self::$_instances[$type])) {
			switch ($type) {
				case self::CLASSIC:
					self::$_instances[$type] = new Classic();
					break;
				case self::INCASO:
					self::$_instances[$type] = new Incaso();
					break;
				case self::STORNO:
					self::$_instances[$type] = new Storno();
					break;
				case self::PERCENT:
					self::$_instances[$type] = new Percent();
					break;
				default:
					throw new InvalidArgumentException("Invalid settlement type '" . $type . "' given");
			}
		}

		return self::$_instances[$type];
	}
}