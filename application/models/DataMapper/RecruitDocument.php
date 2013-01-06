<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class RecruitDocument extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\RecruitDocuments";

	protected function _doCreate()
	{
		$model = new \Model\RecruitDocument();
		$model->recruit = new \Model\Recruit();
		$model->document = new \Model\Document();
		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\RecruitDocument();
		$row = $this->getDbTable()->find($id)->current();
		$model->recruit = $em->find("Recruit", $row['recruit_id']);
		$model->document = $em->find("Document", $row['document_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"recruit_id" => $model->recruit->getIdentifier(),
			"document_id" => $model->document->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"recruit_id" => $model->recruit->getIdentifier(),
			"document_id" => $model->document->getIdentifier()
		);

		$this->getDbTable()->update($data, "recruit_document_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("recruit_document_id = " . $model->getIdentifier());
	}
}