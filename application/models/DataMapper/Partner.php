<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use \Application\Entity\EntityManager;

class Partner extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Partners";

	protected function _doCreate()
	{
		$partner = new \Model\Partner();
		$partner->contactPerson = new \Model\ContactPerson();
		$partner->products = new \Application\Model\Collection\Collection();
		$partner->customers = new \Application\Model\Collection\Collection();

		return $partner;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$partner = new \Model\Partner();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($partner, $row);
		$partner->contactPerson = $em->find("ContactPerson", $row['contact_person_id']);
		$partner->products = new \Application\Model\Collection\VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Product");
			return $dataMapper->findDependentRowset($row, "Partner");
		});
		return $partner;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"description" => $model->description,
			"active" => $model->active,
			"contact_person_id" => $model->contactPerson->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"description" => $model->description,
			"active" => $model->active,
			"contact_person_id" => $model->contactPerson->getIdentifier()
		);

		$this->getDbTable()->update($data, "partner_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "partner_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->addCondition("deleted = 0", $where);
		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}