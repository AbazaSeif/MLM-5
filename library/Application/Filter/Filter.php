<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Filter;

class Filter
{
	const SESSION_NAMESPACE = "filters";

	/**
	 * Zend Db Select
	 * @var \Zend_Db_Select
	 */
	private $_select;

	/**
	 * getSelect()
	 *
	 * @return \Zend_Db_Select
	 */
	public function getSelect()
	{
		return $this->_select;
	}

	public function filter(\Zend_Db_Select $select)
	{
		$data = $this->getFilterData();
		$this->_select = $select;

		foreach ($data as $key => $value) {
			if (!empty($value)) {
				$method = "filterBy" . ucfirst(preg_replace("/_(\w{1})/e", "ucfirst('$1')", $key));
				if (method_exists($this, $method)) {
					call_user_func(array($this, $method), trim($value));
				} else {
					unset($data[$key]);
				}
			}
		}
		$this->_storeFilterDataInSession($data);

		return $select;
	}

	public function getFilterData()
	{
		$dataFromSession = $this->_getFilterDataFromSession();
		$dataFromPost = $this->_getFilterDataFromPost();

		$data = array_merge($dataFromSession, $dataFromPost);
		if (isset($_POST['reset'])) {
			$data = array();
		}

		return $data;
	}

	private function _getFilterDataFromSession()
	{
		$session = $this->_getSession();
		$data = array();

		foreach ($session as $key => $value) {
			$data[$key] = $value;
		}

		return $data;
	}

	private function _getSession()
	{
		return new \Zend_Session_Namespace(self::SESSION_NAMESPACE);
	}

	private function _getFilterDataFromPost()
	{
		$data = array();
		$request = \Zend_Controller_Front::getInstance()->getRequest();
		if ($request->isPost()) {
			$filterForm = "\Filter_Form_" . ucfirst($request->getControllerName());
			$form = new $filterForm();
			if ($form->isValid($_POST)) {
				$data = $form->getValues();
			}
		}

		return $data;
	}

	private function _storeFilterDataInSession(array $data)
	{
		$session = $this->_getSession();
		$session->unsetAll();

		foreach ($data as $key => $value) {
			$session->$key = $value;
		}
	}
}