<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Form\Decorator;

/**
 * FormInfo decorator
 */
class FormInfo extends \Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$xhtml = "<p class='form-info'>"
			. "Pola oznaczone * są wymagane"
			. "</p>";

		return $xhtml . $content;
	}
}