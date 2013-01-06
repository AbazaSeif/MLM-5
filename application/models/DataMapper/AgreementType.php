<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use \Application\Entity\EntityManager;
use \Application\Model\Collection\Collection;
use \Application\Model\Collection\VirtualCollection;

class AgreementType extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\AgreementTypes";

	protected function _doCreate()
	{
		$agreementType = new \Model\AgreementType();

		return $agreementType;
	}

	protected function _doLoad($id)
	{
		$agreementType = new \Model\AgreementType();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($agreementType, $row);

		return $agreementType;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"tax" => $model->tax,
			"active" => $model->active
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"name" => $model->name,
			"tax" => $model->tax,
			"active" => $model->active
		);

		$this->getDbTable()->update($data, "agreement_type_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("agreement_type_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}