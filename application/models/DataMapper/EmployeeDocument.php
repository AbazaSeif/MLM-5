<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class EmployeeDocument extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\EmployeeDocuments";

	protected function _doCreate()
	{
		$model = new \Model\EmployeeDocument();
		$model->employee = new \Model\Employee();
		$model->document = new \Model\Document();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\EmployeeDocument();
		$row = $this->getDbTable()->find($id)->current();
		$model->employee = $em->find("Employee", $row['employee_id']);
		$model->document = $em->find("Document", $row['document_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"document_id" => $model->document->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"document_id" => $model->document->getIdentifier()
		);

		$this->getDbTable()->update($data, "employee_document_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("employee_document_id = " . $model->getIdentifier());
	}
}