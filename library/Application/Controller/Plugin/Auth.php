<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

class Auth extends \Zend_Controller_Plugin_Abstract
{
	const SESSION_NAMESPACE = "referer";

	public function routeShutdown(\Zend_Controller_Request_Abstract $request)
	{
		if ($request->getControllerName() == "login") {
			return;
		} else if ($request->getControllerName() == "logout") {
			\Zend_Auth::getInstance()->clearIdentity();
		}

		$auth = \Zend_Auth::getInstance();

		if ($auth->hasIdentity() == false) {
			$session = new \Zend_Session_Namespace(self::SESSION_NAMESPACE);
			$session->referer = $this->getRequest()->getRequestUri();

            $request->setModuleName("default");
			$request->setControllerName("login");
			$request->setActionName("index");
		}
	}

	public function preDispatch()
	{
		$view = \Zend_Layout::getMvcInstance()->getView();
		$view->employee = \Zend_Auth::getInstance()->getIdentity();
	}
}