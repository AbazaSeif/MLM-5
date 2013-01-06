<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class SettlementType extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\SettlementTypes";

	protected function _doCreate()
	{
		return new \Model\SettlementType();
	}

	protected function _doLoad($id)
	{
		$settlementType = new \Model\SettlementType();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($settlementType, $row);

		return $settlementType;
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

		$this->getDbTable()->update($data, "settlement_type_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("settlement_type_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}