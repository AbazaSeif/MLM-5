<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class ApplicationShipment extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\ApplicationShipments";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ApplicationShipment();
		$model->application = $em->create("Application");
		$model->shipment = $em->create("Shipment");
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ApplicationShipment();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->application = $em->find("Application", $row['application_id']);
		$model->shipment = $em->find("Shipment", $row['shipment_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"shipment_id" => $model->shipment->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"shipment_id" => $model->shipment->getIdentifier()
		);

		$this->getDbTable()->update($data, "application_shipment_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("application_shipment_id = " . $model->getIdentifier());
	}
}