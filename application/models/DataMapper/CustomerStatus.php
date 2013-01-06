<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class CustomerStatus extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\CustomerStatuses";

	protected function _doCreate()
	{
		return new \Model\CustomerStatus();
	}

	protected function _doLoad($id)
	{
		$customerStatus = $this->create();
		$data = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($customerStatus, $data);

		return $customerStatus;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" 	=> $model->name,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" 	=> $model->name,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "customer_status_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("customer_status_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}