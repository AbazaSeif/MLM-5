<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Plugin;

use \Application\Access\Manager;

/**
 * Privileges controller plugin
 *
 * Check if the user has right to action in controller
 *
 *
 *
 * @author adrian
 *
 */
class Privileges extends \Zend_Controller_Plugin_Abstract
{
	public function preDispatch(\Zend_Controller_Request_Abstract $request)
	{
		if ($request->getControllerName() == "login"
			|| $request->getControllerName() == "privilegese"
		    || $request->getControllerName() == "index"
		    || $request->getControllerName() == "error"
		) {
			return;
		}

		$controller = str_replace('-', '', $request->getControllerName());
		$action = $this->_mapActionToAccessAction($request->getActionName());
		$privileges = new \Zend_Config_Xml(APPLICATION_PATH . "/configs/privileges.xml");
		$modules = $this->_findAllModules($privileges, $controller);

		$hasPrivilege = false;
		foreach ($modules as $module) {
			$module = $this->_mapModuleToAcceesModule($module);
			$hasPrivilege = $hasPrivilege || Manager::hasAccess($action, $module);
		}

		if ($hasPrivilege == false) {
			$request->setControllerName("privileges");
			$request->setActionName("index");
		}

	}

	private function _mapActionToAccessAction($action)
	{
	    $accessAction = Manager::ACTION_READ;
	    $action = strtolower($action);

	    if ($action == "addbonus") {
	        $action = "add";
	    }

		switch ($action) {
			case "add":
			    $accessAction = Manager::ACTION_UPDATE;
			    break;
			case "edit":
			    if ($this->getRequest()->isPost()) {
				    $accessAction = Manager::ACTION_UPDATE;
			    }
			    break;
			case "delete":
				$accessAction = Manager::ACTION_DELETE;
				break;
		}

		return $accessAction;
	}

	private function _findAllModules(\Zend_Config $config, $value)
	{
		$found = array();
		$value = strtolower($value);

		foreach ($config as $index => $module) {
			$names = $module->controllers->name;
			if (is_string($names)) {
				if (strtolower($names) == $value) {
					$found[] = $index;
				}
			} else {
				foreach ($names as $name) {
					if (strtolower($name) == $value) {
						$found[] = $index;
					}
				}
			}
		}

		return $found;
	}

	private function _mapModuleToAcceesModule($module)
	{
		$module = "\Application\Access\Manager::MODULE_" . strtoupper($module);
		return constant($module);
	}
}
