<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Layer_DocumentController extends Zend_Controller_Action
{
	public function uploadAction()
	{
		$uploader = new \Application\Form\Uploader\qqFileUploader();
		$result = $uploader->handleUpload(APPLICATION_PATH . "/../tmp/");
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

		$this->getHelper("layout")->disableLayout();
		$this->getHelper("viewRenderer")->setNoRender();
	}
}