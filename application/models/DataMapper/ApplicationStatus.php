<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use \Model;

class ApplicationStatus extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\ApplicationStatuses";

	protected function _doCreate()
	{
		return new \Model\ApplicationStatus();
	}

	protected function _doLoad($id)
	{
		$applicationStatus = new \Model\ApplicationStatus();
		$data = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($applicationStatus, $data);

		return $applicationStatus;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active,
			"taken_to_settle" => $model->takenToSettle
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active,
			"taken_to_settle" => $model->takenToSettle
		);

		$this->getDbTable()->update($data, "application_status_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("application_status_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}