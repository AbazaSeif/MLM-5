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

class NewsGroup extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "\DbTable\NewsGroups";

	protected function _doCreate()
	{
		$newsGroup = new \Model\NewsGroup();
		$newsGroup->news = new \Model\News();
		$newsGroup->group = new \Model\EmployeeGroup();

		return $newsGroup;
	}

	protected function _doLoad($id)
	{
		$newsGroup = new \Model\NewsGroup();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($newsGroup, $row);

		$em = EntityManager::getInstance();
		$newsGroup->news = $em->find("News", $row['news_id']);
		$newsGroup->group = $em->find("EmployeeGroup", $row['employee_group_id']);

		return $newsGroup;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
		    "news_id" => $model->news->getIdentifier(),
		    "employee_group_id" => $model->group->getIdentifier()
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
            "news_id" => $model->news->getIdentifier(),
            "employee_group_id" => $model->group->getIdentifier()
		);

		$this->getDbTable()->update($data, "news_group_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("news_group_id = " . $model->getIdentifier());
	}

	public function loadAllActive($offset = null, $count = null, $where = null)
	{
		return parent::loadAll($offset, $count, $where);
	}
}