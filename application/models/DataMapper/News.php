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

class News extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\News";

	protected function _doCreate()
	{
		$news = new \Model\News();
		$news->employee = new \Model\Employee();
		$news->groups = new \Application\Model\Collection\Collection();

		return $news;
	}

	protected function _doLoad($id)
	{
		$news = new \Model\News();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($news, $row);

		$em = EntityManager::getInstance();
		$news->employee = $em->find("Employee", $row['employee_id']);
		$news->groups = new \Application\Model\Collection\VirtualCollection(function() use ($em, $row) {
			$dataMapper = $em->getDataMapper("NewsGroup");
			return $dataMapper->findDependentRowset($row, "News");
		});

		return $news;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"title" => $model->title,
			"text" => $model->text,
		    "create_date" => $model->createDate,
			"active" => $model->active,
		    "employee_id" => $model->employee->getIdentifier(),
		    "attachment" => $model->attachment
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"title" => $model->title,
			"text" => $model->text,
			"active" => $model->active
		);

		$filename = $model->attachment;

		if (!empty($filename)) {
		    $data['attachment'] = $filename;
		}

		$this->getDbTable()->update($data, "news_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("news_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		$where = $this->addCondition("active = 1", $where);
		return parent::loadAll($offset, $count, $where);
	}
}