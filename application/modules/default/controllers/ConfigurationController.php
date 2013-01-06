<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

class ConfigurationController extends Zend_Controller_Action
{
    public function indexAction()
    {
    	$em = \Application\Entity\EntityManager::getInstance();
    	$model = $em->create("Configuration");
		$form = new Configuration_Form($model);
		$this->getHelper("formAction")->action($form, $model, true);
		$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\Configuration $model)
    {
    	$values = $form->getValue("incaso");
    	$model->incasoParts = $values['incaso_parts'];

    	$values = $form->getValue("storno");
    	$model->stornoInterval = $values['storno_interval'];
    	$model->stornoFirstPartPercent = $values['storno_first_part_percent'];
    	$model->stornoSecondPartPercent = $values['storno_second_part_percent'];

    	$values = $form->getValue("tax-free");
    	$model->taxFreeAllowance = $values['tax_free_allowance'];
    	$model->taxPercent = $values['tax_percent'];
    }
}