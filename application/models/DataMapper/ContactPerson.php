<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use Application\Model\Collection\VirtualCollection;
use Application\Model\Collection\Collection;
use Application\Entity\EntityManager;

class ContactPerson extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\ContactPersons";

	public function _doCreate()
	{
		$contactPerson = new \Model\ContactPerson();
		$contactPerson->state = new \Model\State();
		$contactPerson->partners = new Collection();
		$contactPerson->products = new Collection();

		return $contactPerson;
	}

	public function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$contactPerson = new \Model\ContactPerson();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($contactPerson, $row);
		$contactPerson->state = EntityManager::getInstance()->find("State", $row['state_id']);
		$contactPerson->partners = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("Partner");
			return $dataMapper->findDependentRowset($row, "ContactPerson");
		});
		$contactPerson->products = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("Product");
			return $dataMapper->findDependentRowset($row, "ContactPerson");
		});

		return $contactPerson;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"street" => $model->street,
			"city" => $model->city,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"phone_number" => $model->phoneNumber,
			"email" => $model->email,
			"position" => $model->position,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"street" => $model->street,
			"city" => $model->city,
			"postcode" => $model->postcode,
			"state_id" => $model->state->getIdentifier(),
			"phone_number" => $model->phoneNumber,
			"email" => $model->email,
			"position" => $model->position,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "contact_person_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("contact_person_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}