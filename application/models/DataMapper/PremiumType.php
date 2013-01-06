<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class PremiumType extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\PremiumTypes";

	protected function _doCreate()
	{
		return new \Model\PremiumType();
	}

	protected function _doLoad($id)
	{
		$model = new \Model\PremiumType();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"period_in_months" => $modle->periodInMonths,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"period_in_months" => $modle->periodInMonths,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "agreement_type_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("premium_type_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}