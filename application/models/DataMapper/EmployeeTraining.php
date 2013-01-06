<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class EmployeeTraining extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\EmployeeTrainings";

	protected function _doCreate()
	{
		$model = new \Model\EmployeeTraining();
		$model->employee = new \Model\Employee();
		$model->training = new \Model\Training();
		$model->examiner = new \Model\Employee();

		return $model;
	}

	public function _doLoad($id)
	{
		$em = \Application\Entity\EntityManager::getInstance();
		$model = new \Model\EmployeeTraining();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->employee = $em->find("Employee", $row['employee_id']);
		$model->training = $em->find("Training", $row['training_id']);
		$model->examiner = $em->find("Employee", $row['examiner_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"training_id" => $model->training->getIdentifier(),
			"mark" => $model->mark,
			"create_date" => $model->createDate,
			"examiner_id" => $model->examiner->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"training_id" => $model->training->getIdentifier(),
			"mark" => $model->mark,
			"examiner_id" => $model->examiner->getIdentifier()
		);
		$this->getDbTable()->update($data, "employee_training_id = " . $model-> getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("employee_training_id = " . $model-> getIdentifier());
	}
}