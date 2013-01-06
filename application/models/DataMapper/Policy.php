<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;
use Application\Model\Collection\Collection;

use Application\Entity\EntityManager,
	Application\Model\Collection\VirtualCollection;

class Policy extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\Policy";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$policy = new \Model\Policy();
		$policy->application = $em->create("Application");

		return $policy;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$policy = new \Model\Policy();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($policy, $row);
		$policy->application = $em->find("Application", $row['application_id']);

		return $policy;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"outer_number" => $model->outerNumber,
			"create_date" => $model->createDate,
			"end_date" => $model->endDate,
			"pop_place" => $model->popPlace,
			"delivery_date" => $model->deliveryDate,
			"pop_return_date" => $model->popReturnDate
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"outer_number" => $model->outerNumber,
			"create_date" => $model->createDate,
			"end_date" => $model->endDate,
			"pop_place" => $model->popPlace,
			"delivery_date" => $model->deliveryDate,
			"pop_return_date" => $model->popReturnDate
		);

		$this->getDbTable()->update($data, "policy_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("policy_id = " . $model->getIdentifier());
	}
}