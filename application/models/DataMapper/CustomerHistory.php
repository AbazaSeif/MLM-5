<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class CustomerHistory extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\CustomerHistory";

	protected function _doCreate()
	{
		$model = new \Model\CustomerHistory();
		$model->customer = new \Model\Customer();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\CustomerHistory();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->customer = $em->find("Customer", $row['customer_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"date" => $model->date,
			"info" => $model->info
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"date" => $model->date,
			"info" => $model->info
		);

		$this->getDbTable()->update($data, "customer_history_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("customer_history_id = " . $model->getIdentifier());
	}
}