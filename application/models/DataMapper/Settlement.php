<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use \Application\Entity\EntityManager;

class Settlement extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Settlements";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$settlement = new \Model\Settlement();
		$settlement->application = $em->create("Application");
		$settlement->employee = $em->create("Employee");

		return $settlement;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$settlement = new \Model\Settlement();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($settlement, $row);
		$settlement->application = $em->find("Application", $row['application_id']);
		$settlement->employee = $em->find("Employee", $row['employee_id']);

		return $settlement;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$minute = date("i") % date("t");

		$data = array(
			"create_date" => date("Y-m-") . $minute,
			"application_id" => $model->application->getIdentifier(),
			"employee_id" => $model->employee->getIdentifier(),
			"settlement_total_id" => $model->settlementTotal->getIdentifier(),
			"amount" => $model->amount,
			"parts" => $model->parts
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"employee_id" => $model->employee->getIdentifier(),
			"settlement_total_id" => $model->settlementTotal->getIdentifier(),
			"amount" => $model->amount,
			"parts" => $model->parts
		);

		$this->getDbTable()->update($data, "settlement_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("settlement_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->checkPrivileges($where);
		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->checkPrivileges($where);
		return parent::loadAll($offset, $count, $where);
	}
}