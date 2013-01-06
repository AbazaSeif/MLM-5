<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class SettlementTotal extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\SettlementTotals";

	protected function _doCreate()
	{
		$model = new \Model\SettlementTotal();
		$model->employee = new \Model\Employee();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\SettlementTotal();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->employee = $em->find("Employee", $row['employee_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"create_date" => $model->createDate,
			"total" => $model->total,
			"tax" => $model->tax
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"create_date" => $model->createDate,
			"total" => $model->total,
			"tax" => $model->tax
		);

		$this->getDbTable()->update($data, "settlement_total_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("settlement_total_id = " . $model->getIdentifier());
	}
}