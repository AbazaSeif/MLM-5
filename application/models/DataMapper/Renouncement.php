<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Model\Collection\VirtualCollection;

use Application\Entity\EntityManager;

use Application\Model\Collection\Collection;

class Renouncement extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\Renouncements";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$model  = new \Model\Renouncement();
		$model->customer = $em->create("Customer");
		$model->documents = new Collection();
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\Renouncement();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->documents = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("Document");
			return $dataMapper->findManyToManyRowset($row, "DbTable\Document", "DbTable\RenouncementDocuments");
		});
		$model->customer = $em->find("Customer", $row['customer_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"policy_number" => $model->policyNumber,
			"policy_create_date" => $model->policyCreateDate,
			"document_send_date" => $model->documentSendDate
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"policy_number" => $model->policyNumber,
			"policy_create_date" => $model->policyCreateDate,
			"document_send_date" => $model->documentSendDate
		);

		$this->getDbTable()->update($data, "renouncement_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("renouncement_id = " . $model->getIdentifier());
	}
}