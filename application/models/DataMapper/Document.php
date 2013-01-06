<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class Document extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Documents";

	protected function _doCreate()
	{
		$model = new \Model\Document();
		$model->employee = new \Model\Employee();
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = \Application\Entity\EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();
		$model = new \Model\Document();
		$this->_simpleMap($model, $row);
		$model->employee = $em->find("Employee", $row['employee_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"type" => $model->type,
			"employee_id" => $model->employee->getIdentifier(),
			"path" => $model->path,
			"create_date" => $model->createDate
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"type" => $model->type,
			"employee_id" => $model->employee->getIdentifier(),
			"path" => $model->path
		);

		$this->getDbTable()->update($data, "document_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("document_id = " . $model->getIdentifier());
	}
}