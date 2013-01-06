<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class CurrencyController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("Currency");
    }

    public function addAction()
    {
    	$em =  EntityManager::getInstance();
    	$model = $em->create("Currency");
    	$form = new Currency_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Currency $model)
    {
    	$values = $form->getValue("basic");
    	$model->name = $values['name'];
    	$model->active = $values['active'];
    	$model->rate = $values['rate'];
    }

    public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("Currency", $this->_getParam("id"));
    	$form = new Currency_Form($model);
    	$this->getHelper("formAction")->action($form, $model);
    	$this->view->form = $form;
    }

	public function deleteAction()
	{
		$model = EntityManager::getInstance()->find("Currency", $this->_getParam("id"));
		EntityManager::getInstance()->delete($model);
		$this->_redirect("/currency");
	}
}







