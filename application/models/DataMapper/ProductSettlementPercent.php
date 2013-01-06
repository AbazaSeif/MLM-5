<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use \Application\Entity\EntityManager;

class ProductSettlementPercent extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\ProductSettlementPercents";

	protected function _doCreate()
	{
		$model = new \Model\ProductSettlementPercent();
		$model->product = new \Model\Product();
		$model->employeePosition = new \Model\EmployeePosition();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ProductSettlementPercent();
		$row = $this->getDbTable()-> find($id)->current();
		$this->_simpleMap($model, $row);
		$model->product = $em->find("Product", $row['product_id']);
		$model->employeePosition = $em->find("EmployeePosition", $row['employee_position_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"product_id" => $model->product->getIdentifier(),
			"employee_position_id" => $model->employeePosition->getIdentifier(),
			"value" => $model->value
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"product_id" => $model->product->getIdentifier(),
			"employee_position_id" => $model->employeePosition->getIdentifier(),
			"value" => $model->value
		);

		$this->getDbTable()->update($data, "product_settlement_percent_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("product_settlement_percent_id = " . $model->getIdentifier());
	}
}