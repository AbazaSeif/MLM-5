<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Entity\EntityManager;

class NewsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->getHelper("paginator")->paginate("News");
    }

    public function addAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->create("News");
    	$form = new News_Form($model);
    	if ($this->getHelper("formAction")->action($form, $model, true)) {
    	   $this->setGroups($form, $model);
    	   $this->getHelper("formAction")->endAction($model);
    	}
    	$this->view->form = $form;
    }

    public function setModel(\Application\Form\Form $form, \Model\News $model)
    {
    	$values = $form->getValue("basic");
    	$model->title = $values['title'];
    	$model->text = $values['text'];
    	$model->active = $values['active'];

    	if ($values['document'] && !empty($values['document'])) {
        	$oldFilename = APPLICATION_PATH . "/../tmp/" . $values['document'];
        	$uniqName = md5(time()) . "." . pathinfo($oldFilename, PATHINFO_EXTENSION);
        	$newFilename = APPLICATION_PATH . "/../public/documents/" . $uniqName;
        	rename($oldFilename, $newFilename);

        	$model->attachment = $uniqName;
    	}

    	$employee = Zend_Auth::getInstance()->getIdentity();
    	$em = EntityManager::getInstance();

    	$model->employee = $em->find("Employee", $employee->employee_id);
    	$model->createdDate = date("Y-m-d H:i:s");
    }

    public function setGroups(\Application\Form\Form $form, \Model\News $model)
    {
        $em = EntityManager::getInstance();

        $groupsSubForm = $form->getValue("groups");
        $groups = $groupsSubForm['group'];

        $modelGroups = array();

        foreach ($model->groups as $newsGroup) {
            $group = $newsGroup->group;

            if ($group->active && !in_array($group->getIdentifier(), $groups)) {
                $em->delete($newsGroup);
            } else {
                $modelGroups[] = $group->getIdentifier();
            }
        }

        foreach ($groups as $group) {
            if (!in_array($group, $modelGroups)) {
                $newsGroup = $em->create("NewsGroup");
                $newsGroup->news = $model;
                $newsGroup->group = $em->find("EmployeeGroup", $group);
                $em->persist($newsGroup);
            }
        }
    }

    public function editAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("News", $this->_getParam("id"));
    	$form = new News_Form($model);
    	if ($this->getHelper("formAction")->action($form, $model)) {
    	    $this->setGroups($form, $model);
    	    $this->getHelper("formAction")->endAction($model);
    	}
    	$this->view->form = $form;
    }

    public function deleteAction()
    {
    	$em = EntityManager::getInstance();
    	$model = $em->find("News", $this->_getParam("id"));
    	$em->delete($model);

    	$this->_redirect("/news");
    }
}