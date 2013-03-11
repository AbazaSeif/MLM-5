<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Zend_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
	public function flashMessenger()
	{
		$flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper("flashMessenger");
		$messages = $flashMessenger->getMessages() + $flashMessenger->getCurrentMessages();
		$flashMessenger->clearCurrentMessages();

		$xhtml = "";
		foreach ($messages as $message) {
			list($type, $msg) = each($message);
			$xhtml .= "<div class='message-container " . $type . "'><p>" . $msg . "</p></div>";
		}

		return $xhtml;
	}
}