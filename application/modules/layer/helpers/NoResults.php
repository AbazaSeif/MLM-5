<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Zend_View_Helper_NoResults extends Zend_View_Helper_Abstract
{
	public function noResults()
	{
		return 	'<div class="message-container information">' .
						'<p>Brak wyników do wyświetlenia</p>' .
					'</div>';
	}
}