<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use \Application\Entity\EntityManager;
use \Application\Model\Collection\Collection;
use \Application\Model\Collection\VirtualCollection;

/**
 * Recruit Data Mapper
 */
class Recruit extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Recruits";

	protected function _doCreate()
	{
		$model = new \Model\Recruit();
		$model->parentEmployee = new \Model\Employee();
		$model->position = new \Model\EmployeePosition();
		$model->documents = new \Application\Model\Collection\Collection();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();

		$model = new \Model\Recruit();
		$this->_simpleMap($model, $row);
		$model->parentEmployee = $em->find("Employee", $row['parent_employee_id']);
		$model->position = $em->find("EmployeePosition", $row['employee_position_id']);

		if ($row['verifier_id']) {
		    $model->verifier = $em->find("Employee", $row['verifier_id']);
		}

		$model->documents = new \Application\Model\Collection\VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("Document");
			return $dataMapper->findManyToManyRowset(
				$row, "\DbTable\Documents", "\DbTable\RecruitDocuments",
				"Recruit", "Document"
			);
		});

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"email" => $model->email,
			"phone_number" => $model->phoneNumber,
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"description" => $model->description,
			"parent_employee_id" => $model->parentEmployee->getIdentifier(),
			"active" => $model->active,
			"employee_position_id" => $model->position->getIdentifier(),
			"create_date" => $model->createDate
		);

		if ($model->verifier) {
		    $data['verifier_id'] = $model->verifier->getIdentifier();
		}

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"email" => $model->email,
			"phone_number" => $model->phoneNumber,
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"description" => $model->description,
			"parent_employee_id" => $model->parentEmployee->getIdentifier(),
			"active" => $model->active,
			"employee_position_id" => $model->position->getIdentifier(),
			"create_date" => $model->createDate
		);

		if ($model->verifier) {
		    $data['verifier_id'] = $model->verifier->getIdentifier();
		}

		$this->getDbTable()->update($data, "recruit_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "recruit_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->addCondition("deleted = 0", $where);
		$where = $this->checkPrivileges($where, "parent_employee_id");
		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		$where = $this->checkPrivileges($where, "parent_employee_id");
		return parent::loadAll($offset, $count, $where);
	}
}