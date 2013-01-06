<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

class RelatedLinks extends \Zend_Controller_Plugin_Abstract
{
	public function preDispatch(\Zend_Controller_Request_Abstract $request)
	{
		$controllerName = $request->getControllerName();
		$relatedLinksConfig = new \Zend_Config_Xml(APPLICATION_PATH . "/configs/related_links.xml", "links");
		$navigation = new \Zend_Navigation($relatedLinksConfig);
		$links = $navigation->findAllByController($controllerName);

		if (count($links) > 0) {
			$view = \Zend_Layout::getMvcInstance()->getView();
			$view->related_links = $links;
		}
	}
}