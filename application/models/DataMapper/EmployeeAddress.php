<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use \Application\Entity\EntityManager;

class EmployeeAddress extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\EmployeeAddresses";

	protected function _doCreate()
	{
		$employeeAddress = new \Model\EmployeeAddress();
		$employeeAddress->employee = new \Model\Employee();
		$employeeAddress->state = new \Model\State();

		return $employeeAddress;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();

		$employeeAddress = new \Model\EmployeeAddress();
		$this->_simpleMap($employeeAddress, $row);
		$employeeAddress->employee = $em->find("Employee", $row['employee_id']);
		$employeeAddress->state = $em->find("State", $row["state_id"]);

		return $employeeAddress;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"street"	 => $model->street,
			"city" => $model->city,
			"house_number" => $model->houseNumber,
			"flat_number" => $model->flatNumber,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"address_type" => $model->addressType
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"employee_id" => $model->employee->getIdentifier(),
			"street"	 => $model->street,
			"city" => $model->city,
			"house_number" => $model->houseNumber,
			"flat_number" => $model->flatNumber,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"address_type" => $model->addressType
		);

		$this->getDbTable()->update($data, "employee_address_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("employee_address_id = " . $model->getIdentifier());
	}
}