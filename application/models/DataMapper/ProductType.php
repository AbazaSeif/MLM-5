<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use \Application\Model\Collection\Collection,
	 \Application\Model\Collection\VirtualCollection,
	 \Application\Entity\EntityManager;

class ProductType extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\ProductTypes";

	protected function _doCreate()
	{
		$productType = new \Model\ProductType();

		return $productType;
	}

	protected function _doLoad($id)
	{
		$productType = $this->create();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($productType, $row);

		return $productType;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "product_type_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("product_type_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}