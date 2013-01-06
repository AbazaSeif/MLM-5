<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $employee = \Zend_Auth::getInstance()->getIdentity();
        $employeeGroupId = $employee->employee_group_id;

        $this->getHelper("paginator")->paginate("NewsGroup", "employee_group_id = " . $employeeGroupId);
    }
}



