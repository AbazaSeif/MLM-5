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
 * Employee Data Mapper
 */
class Employee extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Employees";

	protected static $_children = array();

	protected function _doCreate()
	{
		$employee = new \Model\Employee();
		$employee->parentEmployee = new \Model\Employee();
		$employee->agreementType = new \Model\AgreementType();
		$employee->position = new \Model\EmployeePosition();
		$employee->addresses = new Collection();
		$employee->privileges = new Collection();
		$employee->documents = new Collection();
		$employee->customers = new Collection();
		$employee->group = new \Model\EmployeeGroup();
		$employee->trainings = new Collection();

		return $employee;
	}

	protected function _doLoad($id)
	{
// 		TODO remove $this->create();
		$em = EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();
		$model = $this->create();
		$this->_simpleMap($model, $row);
		$model->password = null;
		if (!is_null($row['parent_employee_id'])) {
			$model->parentEmployee = $em->find("Employee", $row['parent_employee_id']);
		} else {
			$model->parentEmployee = $em->create("Employee");
		}
		$model->agreementType = $em->find("AgreementType", $row['agreement_type_id']);
		$model->position = $em->find("EmployeePosition", $row['employee_position_id']);
		$model->addresses = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("EmployeeAddress");
			return $dataMapper->findDependentRowset($row, "Employee");
		});
		$model->privileges = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("EmployeePrivileg");
			return $dataMapper->findDependentRowset($row, "Employee");
		});
		$model->documents = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Document");
			return $dataMapper->findManyToManyRowset($row, "DbTable\Documents", "DbTable\EmployeeDocuments");
		});
		if (empty($row['employee_group_id'])) {
			$model->group = $em->create("EmployeeGroup");
		} else {
			$model->group = $em->find("EmployeeGroup", $row['employee_group_id']);
		}
		$model->trainings = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("EmployeeTraining");
			return $dataMapper->findDependentRowset($row, "Employee");
		});
		$model->customers = new \Application\Model\Collection\VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Customer");
			return $dataMapper->findManyToManyRowset($row, "DbTable\Customers", "DbTable\Applications", "Employee", "Customer");
		});

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$salt = md5(time());
		$password = hash("sha1", $model->password. $salt);

		$data = array(
			"login" => $model->login,
			"password" => $password,
			"salt" => $salt,
			"email" => $model->email,
			"last_login" => $model->lastLogin,
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"description" => $model->description,
			"phone_number" => $model->phoneNumber,
			"cell_phone_number" => $model->cellPhoneNumber,
			"active" => $model->active,
			"agreement_type_id" => $model->agreementType->getIdentifier(),
			"agreement_number" => $model->agreementNumber,
			"agreement_start_date" => $model->agreementStartDate,
			"agreement_end_date" => $model->agreementEndDate,
			"company_name" => $model->companyName,
			"student_card_expiration_date" => $model->studentCardExpirationDate,
			"birth_date" => $model->birthDate,
			"birth_city" => $model->birthCity,
			"mother_name" => $model->motherName,
			"father_name" => $model->fatherName,
			"identity_card" => $model->identityCard,
			"pesel" => $model->pesel,
			"nip" => $model->nip,
			"regon" => $model->regon,
			"employee_position_id" => $model->position->getIdentifier(),
			"bank_name" => $model->bankName,
			"bank_account" => $model->bankAccount,
			"create_date" => $model->createDate
		);

		if ($model->parentEmployee) {
			$data['parent_employee_id'] = $model->parentEmployee->getIdentifier();
		}

		if ($model->group) {
			$data['employee_group_id'] = $model->group->getIdentifier();
		}

		if ($model->access) {
			$data['access'] = $model->access;
		}

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
		self::$_children = array();

	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"login" => $model->login,
			"email" => $model->email,
			"last_login" => $model->lastLogin,
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"description" => $model->description,
			"phone_number" => $model->phoneNumber,
			"cell_phone_number" => $model->cellPhoneNumber,
			"active" => $model->active,
			"agreement_type_id" => $model->agreementType->getIdentifier(),
			"agreement_number" => $model->agreementNumber,
			"agreement_start_date" => $model->agreementStartDate,
			"agreement_end_date" => $model->agreementEndDate,
			"company_name" => $model->companyName,
			"student_card_expiration_date" => $model->studentCardExpirationDate,
			"birth_date" => $model->birthDate,
			"birth_city" => $model->birthCity,
			"mother_name" => $model->motherName,
			"father_name" => $model->fatherName,
			"identity_card" => $model->identityCard,
			"pesel" => $model->pesel,
			"nip" => $model->nip,
			"regon" => $model->regon,
			"employee_position_id" => $model->position->getIdentifier(),
			"bank_name" => $model->bankName,
			"bank_account" => $model->bankAccount,
			"create_date" => $model->createDate,
			"employee_group_id" => $model->group->getIdentifier()
		);

		if ($model->parentEmployee) {
			$data['parent_employee_id'] = $model->parentEmployee->getIdentifier();
		}

		if ($model->group) {
			$data['employee_group_id'] = $model->group->getIdentifier();
		}

		if ($model->password) {
			$salt = md5(time());
			$password = hash("sha1", $model->password. $salt);
			$data['password'] = $password;
			$data['salt'] = $salt;
		}

		if ($model->getIdentifier() == 1) {
			unset($data['parent_employee_id']);
		}

		if ($model->access) {
			$data['access'] = $model->access;
		}

		$this->getDbTable()->update($data, "employee_id = " . $model->getIdentifier());
		self::$_children = array();
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "employee_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->addCondition("deleted = 0", $where);

		$employee = \Zend_Auth::getInstance()->getIdentity();
		$extra = "employee_id = " . $employee->employee_id;
		$where = $this->checkPrivileges($where, "parent_employee_id", $extra, "OR");

		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);

		$employee = \Zend_Auth::getInstance()->getIdentity();
		$extra = "employee_id = " . $employee->employee_id;
		$where = $this->checkPrivileges($where, "parent_employee_id", $extra, "OR");

		return parent::loadAll($offset, $count, $where);
	}

	public static function getChildren($employeeId)
	{
		if (!isset(self::$_children[$employeeId])) {
			self::$_children[$employeeId] = self::_getChildren($employeeId);
		}

		return self::$_children[$employeeId];
	}

	private static function _getChildren($employeeId, &$exclude = array())
	{
		$children = self::findChildren($employeeId);
		array_push($exclude, $employeeId);

		$childrenOfChildren = array();
		foreach ($children as $child) {
			if (empty($exclude) || in_array($child, $exclude) == false) {
				$temp = self::_getChildren($child, $exclude);
				$childrenOfChildren = array_merge($childrenOfChildren, $temp);
			}
		}
		$children = array_merge($children, $childrenOfChildren);

		return $children;
	}

	public static function findChildren($employeeId)
	{
		$db = \Zend_Db_Table::getDefaultAdapter();
		$sql = "SELECT employee_id FROM employees WHERE parent_employee_id = ?";
		return $db->fetchCol($sql, $employeeId);
	}
}