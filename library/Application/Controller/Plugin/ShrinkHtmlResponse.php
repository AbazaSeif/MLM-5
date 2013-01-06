<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

/**
 * Shrink Html Response controller pluginl
 *
 * @author adrian
 *
 */
class ShrinkHtmlResponse extends \Zend_Controller_Plugin_Abstract
{
	public function dispatchLoopShutdown()
	{
		$body = $this->getResponse()->getBody();
		$body = preg_replace('/>\s+</', '><', $body);
		$this->getResponse()->setBody($body);
	}
}