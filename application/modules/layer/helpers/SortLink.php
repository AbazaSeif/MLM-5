<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Controller\Action\Helper\Paginator;

class Zend_View_Helper_SortLink extends \Zend_Controller_Action_Helper_Abstract
{
	public function sortLink($key, $text, $table = null)
	{
		$request = $this->getRequest();
		$sort = $request->getParam("sort");

		if (is_array($key)) {
			if ($table) {
				foreach ($key as &$column) {
					$column = $table . '.' . $column;
				}
			}

			$key = implode(',', $key);
		} else {
			if ($table) {
				$key = $table . '.' . $key;
			}
		}

		$class = '';
		if (($sort == null && strtolower($text) == "id") || $sort == $key) {
			if ($request->getParam("order", Paginator::DEFAULT_ORDER) == Paginator::DEFAULT_ORDER) {
				$order = Paginator::ADDITIONAL_ORDER;
			} else {
				$order = Paginator::DEFAULT_ORDER;
			}
			$class = $order;
		} else {
			$order = Paginator::DEFAULT_ORDER;
		}

		$router = Zend_Controller_Front::getInstance()->getRouter();
		$url = $router->assemble(
			array(
				"sort" 			=> $key,
				"order" 			=> $order
			)
		);

		return "<a href='". $url . "' class='" . $class . "'>" . $text . "</a>";
	}
}