<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Paginator\Adapter;

use \Application\Entity\EntityManager;

class DataMapper implements \Zend_Paginator_Adapter_Interface
{
	private $_dataMapper;
	private $_where = null;
	private $_sort = null;
	private $_order = null;
	private $_filter = null;

	public function __construct($entityClass, $where = null, $sort = null, $order = null)
	{
		$this->_dataMapper = EntityManager::getInstance()->getDataMapper($entityClass);
		$this->_where = $where;
		$this->_sort = $sort;
		$this->_order = $order;
	}

	public function setFilter(\Application\Filter\Filter $filter)
	{
		$this->_filter = $filter;
	}

	public function getItems($offset, $itemCountPerPage)
	{
		$where = $this->getWhere();
		return $this->_dataMapper->loadAll($offset, $itemCountPerPage, $where, $this->_sort, $this->_order);
	}

	public function getWhere()
	{
		$where = null;
		$dbTable = $this->_dataMapper->getDbTable();

		if ($this->_where) {
			$where = $this->_dataMapper->addCondition($this->_where);
		} else {
			$where = $dbTable->select(false)->distinct();
		}

		if (isset($this->_filter)) {
			$where = $this->_filter->filter($where);
		}

		$froms = $where->getPart(\Zend_Db_Select::FROM);
		$where->reset(\Zend_Db_Select::FROM);
		$where->from($dbTable->info("name"), $dbTable->info("primary"));

		$tables = array($dbTable->info("name"));
		foreach ($froms as $key => $from) {
		    if (!in_array($from['tableName'], $tables)) {
		        $tables[] = $from['tableName'];

		        $joinString = explode(" ", $from['joinType']);
		        $joinType = $joinString[1] . ucfirst($joinString[0]);

		        $where->$joinType($from['tableName'], array());
		    }
		}

		return $where;
	}

	public function count()
	{
		$where = $this->getWhere();
		$identifiers = $this->_dataMapper->loadAllIdentifiers(null, null, $where, $this->_sort, $this->_order);
		return count($identifiers);
	}
}