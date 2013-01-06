<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

/**
 * Breadcrumbs controller plugin
 *
 *
 * @author adrian
 *
 */
class BreadCrumbs extends \Zend_Controller_Plugin_Abstract
{
	public function preDispatch(\Zend_Controller_Request_Abstract $request)
	{
// 		TODO routes ?
		$uri = "/" . $this->getRequest()->getControllerName();
		if ($this->getRequest()->getActionName() != "index") {
			$uri .= "/" . $this->getRequest()->getActionName();
		}
		$view = \Zend_Layout::getMvcInstance()->getView();
		$activeNav = $view->getHelper('navigation')->findByUri($uri);
		if ($activeNav) {
			$activeNav->active = true;
			$view->headTitle($activeNav->label);
		}
	}
}