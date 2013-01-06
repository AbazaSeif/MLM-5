<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

class Layout extends \Zend_Controller_Plugin_Abstract
{
	public function preDispatch(\Zend_Controller_Request_Abstract $request)
	{
		$moduleName = $request->getModuleName();
		$layoutHelper = \Zend_Controller_Action_HelperBroker::getStaticHelper("layout");
		$layoutHelper->setLayout($moduleName);
	}
}