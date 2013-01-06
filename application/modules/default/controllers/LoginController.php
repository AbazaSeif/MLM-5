<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class LoginController extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->layout()->disableLayout();
    }

    public function indexAction()
    {
    	$form = new Login_Form();

    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($_POST)) {
				$authAdapter = new Zend_Auth_Adapter_DbTable();
				$authAdapter->setTableName("employees")
					->setIdentityColumn("login")
					->setCredentialColumn("password")
					->setCredentialTreatment("SHA1(CONCAT(?, salt)) && (active = 1 || super_admin = 1)")
					->setIdentity($form->getValue("login"))
					->setCredential($form->getValue("password"));

				$auth = Zend_Auth::getInstance();
				if ($auth->authenticate($authAdapter)->isValid()) {
					$authStorage = $auth->getStorage();
					$employee = $authAdapter->getResultRowObject();
					$authStorage->write($employee);

					$db = Zend_Db_Table::getDefaultAdapter();
					$data = array("last_login" => date("Y-m-d H:i:s"));
					$db->update('employees', $data, "employee_id =" . $employee->employee_id);

					$session = new Zend_Session_Namespace(\Application\Controller\Plugin\Auth::SESSION_NAMESPACE);
					$uri =$session->referer;
					if ($uri == "/" || $uri == "/login" || $uri == "/logout") {
						$this->getHelper("redirector")->gotoSimple("index", "index");
					} else {
						$this->getHelper("redirector")->gotoUrl($uri);
					}
				} else {
					$this->view->formErrors = array("Niepoprawny login lub hasło");
					$this->view->data = $form->getUnfilteredValues();
				}
    		} else {
    			$this->view->formErrors = $form->getMessages();
    			$this->view->data = $form->getUnfilteredValues();
    		}
    	}
    }
}

