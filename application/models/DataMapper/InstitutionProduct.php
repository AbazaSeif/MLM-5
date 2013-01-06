<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class InstitutionProduct extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\InstitutionProducts";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$model =  new \Model\InstitutionProduct();
		$model->institution = $em->create("Institution");
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();
		$model = new \Model\InstitutionProduct();
		$this->_simpleMap($model, $row);
		$model->institution = $em->find("Institution", $row['institution_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active,
			"institution_id" => $model->institution->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active,
			"institution_id" => $model->institution->getIdentifier()
		);

		$this->getDbTable()->update($data, "institution_product_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "institution_product_id = " . $model->getIdentifier());
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