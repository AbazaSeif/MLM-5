<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

class JsonAction extends \Zend_Controller_Plugin_Abstract
{
	public function preDispatch(\Zend_Controller_Request_Abstract $request)
	{
		if ($request->getModuleName() == "json") {
			header("Content-type: application/json");
			$viewRenderer = \Zend_Controller_Action_HelperBroker::getExistingHelper("viewRenderer");
			$viewRenderer->setNeverRender();
		}
	}
}