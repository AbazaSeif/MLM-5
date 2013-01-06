<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class Shipment extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Shipments";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$model = new \Model\Shipment();
		$model->state = $em->create("State");
		$model->type = new \Model\ShipmentType();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();
		$model = new \Model\Shipment();
		$this->_simpleMap($model, $row);
		$model->state = $em->find("State", $row['state_id']);
		$model->type = $em->find("ShipmentType", $row['shipment_type_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"shipment_type_id" => $model->type->getIdentifier(),
			"create_date" => $model->createDate,
			"street" => $model->street,
			"city" => $model->city,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"phone_number" => $model->phoneNumber,
			"email" => $model->email,
			"create_date" => $model->createDate
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"shipment_type_id" => $model->type->getIdentifier(),
			"street" => $model->street,
			"city" => $model->city,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"phone_number" => $model->phoneNumber,
			"email" => $model->email
		);

		$this->getDbTable()->update($data, "shipment_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("shipment_id = " . $model->getIdentifier());
	}
}