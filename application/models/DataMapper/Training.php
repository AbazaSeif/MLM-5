<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class Training extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\Trainings";

	protected function _doCreate()
	{
		return new \Model\Training();
	}

	protected function _doLoad($id)
	{
		$model = new \Model\Training();
		$row = $this->getDbTable()-> find($id)->current();
		$this->_simpleMap($model, $row);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"title" => $model->title,
			"description" => $model->description,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"title" => $model->title,
			"description" => $model->description,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "training_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("training_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}