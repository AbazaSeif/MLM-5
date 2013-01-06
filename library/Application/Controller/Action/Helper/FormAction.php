<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Action\Helper;

use \Application\Entity\EntityManager;

class FormAction extends \Zend_Controller_Action_Helper_Abstract
{
	const SET_MODEL_METHOD = "setModel";

	public function simpleAction(\Zend_Form $form, \Application\Entity\Entity $model, $preventDefault = false)
	{
		$em = EntityManager::getInstance();
		$form->setAction($this->getRequest()->getRequestUri());
		$form->getElement("parent")->setValue($this->getRequest()->getParam("parent"));

		if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
			call_user_func(array($this->getActionController(), self::SET_MODEL_METHOD), $form, $model);
			$em->persist($model);
			if ($preventDefault == false) {
				$this->simpleEndAction();
			}

			return true;
		}
	}

	public function simpleEndAction() {
		$this->getResponse()->setHeader("ajax-form", "completed");
		$this->getActionController()->getHelper("viewRenderer")->setNoRender();
	}

	public function action(\Zend_Form $form, \Application\Entity\Entity $model, $preventDefault = false)
	{
		$flashMessenger = $this->getActionController()->getHelper("flashMessenger");
		$em = EntityManager::getInstance();

		if ($this->getRequest()->isPost()) {
			if ($form->isValid($_POST)) {
				call_user_func(array($this->getActionController(), self::SET_MODEL_METHOD), $form, $model);
				$em->persist($model);
				$flashMessenger->addMessage(array("success" => "Dane zostały pomyślnie zapisane"));

				if ($this->getRequest()->getActionName() != "edit" && $preventDefault == false) {
					$this->endAction($model);
				}
				return true;
			} else {
				$flashMessenger->addMessage(array("warning" => "Dane w formularzu są nieprawidłowe"));
			}
		}
	}

	public function endAction( \Application\Entity\Entity $model)
	{
		$redirector = $this->getActionController()->getHelper("redirector");
		$redirector->goToRoute(
			array(
				"controller" => $this->getRequest()->getControllerName(),
				"action" => "edit",
				"id" => $model->getIdentifier()),
			"edit-without-module"
		);
	}
}