<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class ApplicationPercent extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\ApplicationPercents";

	protected function _doCreate()
	{
		$model = new \Model\ApplicationPercent();
		$model->application = new Application;
		$model->employee = new Employee;
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ApplicationPercent();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->application = $em->find("Application", $row['application_id']);
		$model->employee = $em->find("Employee", $row['employee_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"employee_id" =>	$model->employee->getIdentifier(),
			"percent" => $model->percent,
			"for_seller" => $model->forSeller
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"employee_id" =>	$model->employee->getIdentifier(),
			"percent" => $model->percent,
			"for_seller" => $model->forSeller
		);

		$this->getDbTable()->update($data, "application_percent_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("application_percent_id = " . $model->getIdentifier());
	}
}