<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use \Application\Entity\EntityManager;

class CustomerAddress extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\CustomerAddresses";

	protected function _doCreate()
	{
		$model = new \Model\CustomerAddress();
		$model->customer = new \Model\Customer();
		$model->state = new \Model\State();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\CustomerAddress();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->customer = $em->find("Customer", $row['customer_id']);
		$model->state = $em->find("State", $row['state_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"street" => $model->street,
			"house_number" => $model->houseNumber,
			"flat_number" => $model->flatNumber,
			"city" => $model->city,
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
			"customer_id" => $model->customer->getIdentifier(),
			"street" => $model->street,
			"city" => $model->city,
			"house_number" => $model->houseNumber,
			"flat_number" => $model->flatNumber,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"address_type" => $model->addressType
		);

		$this->getDbTable()->update($data, "customer_address_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("customer_address_id = " . $model->getIdentifier());
	}
}