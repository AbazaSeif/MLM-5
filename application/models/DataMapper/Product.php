<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use \Application\Entity\EntityManager;

class Product extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Products";

	protected function _doCreate()
	{
		$product = new \Model\Product();
		$product->partner = new \Model\Partner();
		$product->currency = new \Model\Currency();
		$product->settlementType = new \Model\SettlementType();
		$product->contactPerson = new \Model\ContactPerson();
		$product->type = new \Model\PremiumType();
		$product->percents = new \Application\Model\Collection\Collection();
		$product->customers = new \Application\Model\Collection\Collection();

		return $product;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$product =new \Model\Product();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($product, $row);
		$product->partner = $em->find("Partner", $row['partner_id']);
		$product->currency = $em->find("Currency", $row['currency_id']);
		$product->settlementType = $em->find("SettlementType", $row['settlement_type_id']);
		$product->contactPerson = $em->find("ContactPerson", $row['contact_person_id']);
		$product->type = $em->find("ProductType", $row['product_type_id']);
		$product->percents = new \Application\Model\Collection\VirtualCollection(function () use ($row, $em) {
			$dataMapper = $em->getDataMapper("ProductSettlementPercent");
			return $dataMapper->findDependentRowset($row, "Product");
		});
		$product->customers = new \Application\Model\Collection\VirtualCollection(function () use ($row, $em) {
			$dataMapper = $em->getDataMapper("Customer");
			return $dataMapper->findManyToManyRowset($row, "DbTable\Customers", "DbTable\Applications", "Product", "Customer");
		});

		return $product;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"description" => $model->description,
			"active" => $model->active,
			"partner_id" => $model->partner->getIdentifier(),
			"currency_id" => $model->currency->getIdentifier(),
			"settlement_type_id" => $model->settlementType->getIdentifier(),
			"contact_person_id" => $model->contactPerson->getIdentifier(),
			"product_type_id" => $model->type->getIdentifier(),
			"seller_percent" => $model->sellerPercent
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);

		$em = EntityManager::getInstance();
		foreach ($model->percents as $percent) {
			$em->persist($percent);
		}
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"description" => $model->description,
			"active" => $model->active,
			"partner_id" => $model->partner->getIdentifier(),
			"currency_id" => $model->currency->getIdentifier(),
			"settlement_type_id" => $model->settlementType->getIdentifier(),
			"contact_person_id" => $model->contactPerson->getIdentifier(),
			"product_type_id" => $model->type->getIdentifier(),
			"seller_percent" => $model->sellerPercent
		);

		$this->getDbTable()->update($data, "product_id = " . $model->getIdentifier());

		$em = EntityManager::getInstance();
		$table = $em->getDataMapper("ProductSettlementPercent")->getDbTable();
		$table->delete("product_id = " . $model->getIdentifier());

		foreach ($model->percents as $percent) {
			$em->persist($percent);
		}
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$data = array("deleted" => 1);
		$this->getDbTable()->update($data, "product_id = ". $model->getIdentifier());
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