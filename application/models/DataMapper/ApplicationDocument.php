<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class ApplicationDocument extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\ApplicationDocuments";

	protected function _doCreate()
	{
		$model = new \Model\ApplicationDocument();
		$model->application = new \Model\Customer();
		$model->document = new \Model\Document();
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\ApplicationDocument();
		$row = $this->getDbTable()->find($id)->current();
		$model->application = $em->find("Application", $row['customer_id']);
		$model->document = $em->find("Document", $row['document_id']);
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"document_id" => $model->document->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"application_id" => $model->application->getIdentifier(),
			"document_id" => $model->document->getIdentifier()
		);

		$this->getDbTable()->update($data, "application_document_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("application_document_id = " . $model->getIdentifier());
	}
}