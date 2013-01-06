<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class State extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\States";

	protected function _doCreate()
	{
		return new \Model\State();
	}

	protected function _doLoad($id)
	{
		$state = new \Model\State();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($state, $row);

		return $state;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array("naem" => $model->name);
		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array("naem" => $model->name);
		$this->getDbTable()->update($data, "state_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("state_id = " . $model->getIdentifier());
	}
}