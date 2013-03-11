<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

/**
 * Related links helper
 */
class Zend_View_Helper_RelatedLinks extends Zend_View_Helper_Abstract
{
	public function relatedLinks()
	{
		$view = Zend_Layout::getMvcInstance()->getView();
		if ($view->related_links) {
			$xhtml = "<ul class='related-links'>"
				. "<li class='first'>powiązane: </li>";

			foreach ($view->related_links as $link) {
				$xhtml .= "<li><a href='" . $link->getParent()->uri . "'>" . $link->getParent()->label . "</a></li>";
			}

			$xhtml .= "</ul>";

			return $xhtml;
		}
	}
}