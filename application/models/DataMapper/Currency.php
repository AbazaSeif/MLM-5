<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class Currency extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Currency";

	protected function _doCreate()
	{
		return new \Model\Currency();
	}

	protected function _doLoad($id)
	{
		$currency = new \Model\Currency();
		$data = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($currency, $data);

		return $currency;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "currency_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "currency_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->addCondition("deleted = 0", $where);
		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}