<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class ApplicationSettlement extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\ApplicationSettlements";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ApplicationSettlement();
		$model->application = $em->create("Application");
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ApplicationSettlement();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->application = $em->find("Application", $row['application_id']);
		$model->configuration = unserialize($model->configuration);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"configuration" => serialize($model->configuration)
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"configuration" => serialize($model->configuration)
		);

		$this->getDbTable()->update($data, "application_settlement_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("application_settlement_id = " . $model->getIdentifier());
	}
}