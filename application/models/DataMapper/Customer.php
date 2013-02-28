<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use Application\Model\Collection\Collection;

use \Application\Entity\EntityManager,
	\Application\Model\Collection\VirtualCollection;

class Customer extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Customers";

	protected function _doCreate()
	{
		$model = new \Model\Customer();
		$model->employee = new \Model\Employee();
		$model->status = new \Model\CustomerStatus();
		$model->group = new \Model\CustomerGroup();
		$model->addresses = new \Application\Model\Collection\Collection();
		$model->documents = new \Application\Model\Collection\Collection();
		$model->products = new \Application\Model\Collection\Collection();
		$model->credits = new \Application\Model\Collection\Collection();
		$model->oldProducts = new \Application\Model\Collection\Collection();
		$model->renouncements = new Collection();
		$model->history = new \Application\Model\Collection\Collection();


		return $model;
	}

	protected function _doLoad($id)
	{
// 		TODO remove $this->create();
		$em = EntityManager::getInstance();
		$model = $this->create();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->employee = $em->find("Employee", $row['employee_id']);
		$model->status = $em->find("CustomerStatus", $row['customer_status_id']);
		$model->addresses = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("CustomerAddress");
			return $dataMapper->findDependentRowset($row, "Customer");
		});
		$model->documents = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Document");
			return $dataMapper->findManyToManyRowset($row, "\DbTable\Documents", "\DbTable\CustomerDocuments");
		});
		$model->products = new VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("Product");
			return $dataMapper->findManyToManyRowset($row, "DbTable\Products", "DbTable\Applications", "Customer", "Product");
		});
	    $model->history = new VirtualCollection(function() use ($em, $row) {
	        $dataMapper = $em->getDataMapper("CustomerHistory");
	        return $dataMapper->findDependentRowset($row, "Customer");
	    });
		$model->oldProducts = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("CustomerOldProduct");
			return $dataMapper->findDependentRowset($row, "Customer");
		});
		$model->credits = new VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("CustomerCredit");
			return $dataMapper->findDependentRowset($row, "Customer");
		});
		$model->group = $em->find("CustomerGroup", $row['customer_group_id']);
		$model->renouncements = new \Application\Model\Collection\VirtualCollection(function() use($em, $row) {
			$dataMapper = $em->getDataMapper("Renouncement");
			return $dataMapper->findDependentRowset($row, "Customer");
		});

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"email" => $model->email,
			"male" => $model->male,
			"birth_date" => $model->birthDate,
			"birth_city" => $model->birthCity,
			"identity_card" => $model->identityCard,
			"pesel" => $model->pesel,
			"nip" => $model->nip,
			"regon" => $model->regon,
			"phone_number" => $model->phoneNumber,
			"cell_phone_number" => $model->cellPhoneNumber,
			"employee_id" => $model->employee->getIdentifier(),
			"customer_status_id" => $model->status->getIdentifier(),
			"recommending_person" => $model->recommendingPerson,
			"date_of_last_analysis" => $model->dateOfLastAnalysis,
			"number_of_last_analysis" => $model->numberOfLastAnalysis,
			"create_date" => $model->createDate,
			"active" => $model->active,
			"customer_group_id" => $model->group->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"firstname" => $model->firstname,
			"lastname" => $model->lastname,
			"email" => $model->email,
			"male" => $model->male,
			"birth_date" => $model->birthDate,
			"birth_city" => $model->birthCity,
			"identity_card" => $model->identityCard,
			"pesel" => $model->pesel,
			"nip" => $model->nip,
			"regon" => $model->regon,
			"phone_number" => $model->phoneNumber,
			"cell_phone_number" => $model->cellPhoneNumber,
			"employee_id" => $model->employee->getIdentifier(),
			"customer_status_id" => $model->status->getIdentifier(),
			"recommending_person" => $model->recommendingPerson,
			"date_of_last_analysis" => $model->dateOfLastAnalysis,
			"number_of_last_analysis" => $model->numberOfLastAnalysis,
			"active" => $model->active,
			"customer_group_id" => $model->group->getIdentifier()
		);

		$this->getDbTable()->update($data, "customer_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "customer_id = " . $model->getIdentifier());
	}

	public function loadAllIdentifiers($offset = null, $count = null, \Zend_Db_Select $where = null, $sort = null, $order = null)
	{
		$where = $this->addCondition("deleted = 0", $where);
		$where = $this->checkPrivileges($where);
		return parent::loadAllIdentifiers($offset, $count, $where, $sort, $order);
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		$where = $this->checkPrivileges($where);
		return parent::loadAll($offset, $count, $where);
	}
}