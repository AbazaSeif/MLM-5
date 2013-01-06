<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\DataMapper;

use Application\Entity\EntityManager;

/**
 * Data Mapper
 */
abstract class DataMapper
{
	protected $_dbTable;
	protected static $_identityMap = array();
	protected static $_entityManager;

	abstract protected function _doCreate();
	abstract protected function _doLoad($id);
	abstract protected function _doInsert(\Application\Entity\Entity $model);
	abstract protected function _doUpdate(\Application\Entity\Entity$model);
	abstract protected function _doDelete(\Application\Entity\Entity $model);

	/**
	 * @return \Zend_Db_Table
	 */
	public function getDbTable()
	{
		if (is_string($this->_dbTable)) {
			$class = $this->_dbTable;
			$this->_dbTable = new $class;
		}

		return $this->_dbTable;
	}

	/**
	 * @param \Zend_Db_Table $dbTable
	 */
	public function setDbTable($dbTable)
	{
		$this->_dbTable = $dbTable;
	}

	public function getEntityManager()
	{
		if (!isset(self::$_entityManager)) {
			self::$_entityManager = EntityManager::getInstance();
		}

		return self::$_entityManager;
	}

	/**
	 * @return \Application\Entity\Entity
	 */
	public function create()
	{
		return $this->_doCreate();
	}

	/**
	 * @param int $id
	 * @return \Application\Entity\Entity
	 */
	public function load($id)
	{
		if (!empty($id)) {
			$class = get_class($this);
			if (!isset(self::$_identityMap[$class])) {
				self::$_identityMap[$class] = array();
			}

			if (!isset(self::$_identityMap[$class][$id])) {
				$model = $this->_doLoad($id);
				$model->setIdentifier($id);
				self::$_identityMap[$class][$id] = $model;
			}

			return self::$_identityMap[$class][$id];
		}

		return null;
	}

	public function loadAllIdentifiers(
		$offset = null, $count = null,
		\Zend_Db_Select $where = null, $sort = null, $order = null
	)
	{
		$dbTable = $this->getDbTable();

		if ($where) {
			$select = $where;
		} else {
			$select = $dbTable->select(false)->from($dbTable->info("name"), $dbTable->info("primary"));
		}

		if ($order) {
			if (empty($sort)) {
				$sort = $dbTable->info("primary");
			} else {
				$sort = (array)$sort;
			}

			array_walk(
				$sort,
				function(&$item) use($order, $select) {
					if ($pos = strpos($item, '.')) {
						$tableName = substr($item, 0, $pos);
						$className = "DbTable\\" . ucfirst(preg_replace("/_(\w{1})/e", "ucfirst('$1')", $tableName));
						$additionalTable = new $className;
						$additionalTablePrimaryKey = array_pop($additionalTable->info("primary"));

						$select->joinLeftUsing($tableName, $additionalTablePrimaryKey, array());
					}

					$item .= ' ' . $order;
				}
			);
			$select->order($sort);
		}

		if (isset($offset) && isset($count)) {
			$select->limit($count, $offset);
		}

		return $dbTable->fetchAll($select);
	}

	public function loadAll($offset = null, $count = null, $where = null, $sort = null, $order = null)
	{
		if ($where) {
			$where = $this->addCondition($where);
		}
		$identifiers = $this->loadAllIdentifiers($offset, $count, $where, $sort, $order);
		return $this->_loadByPrimaryKeys($identifiers);
	}

	/**
	 * addCondition
	 *
	 * @param mixed 		  $condition Condition
	 * @param \Zend_Db_Select $prev 	 Previous select statement
	 *
	 * @return \Zend_Db_Select
	 */
	public function addCondition($condition, $prev = null)
	{
		$dbTable = $this->getDbTable();

		if (isset($prev)) {
			if ($prev instanceof \Zend_Db_Select == false) {
				$prev = $this->addCondition($prev);
			}
			$select = $prev->where($dbTable->info("name") . "." . $condition);
		} else {
			if ($condition instanceof \Zend_Db_Select) {
				$select = $condition->reset(\Zend_Db_Select::COLUMNS)
					->columns($dbTable->info("primary"));
			} else {
				$select = $this->getDbTable()->select(false)
					->from($dbTable->info("name"), $dbTable->info("primary"))
					->where($dbTable->info("name") . "." . $condition);
			}
		}

		return $select;
	}

	protected function _loadByPrimaryKeys(\Zend_Db_Table_Rowset $results)
	{
		$collection = array();
		foreach ($results->toArray() as $row) {
			$collection[] = $this->load(array_shift($row));
		}

		return $collection;
	}

	/**
	 * Finds primary keys of dependent rows
	 *
	 * @param \Zend_Db_Table_Row $row
	 * @param string $dependentTableClass
	 * @param string $rule
	 * @return array
	 */
	public function findDependentRowset(\Zend_Db_Table_Row $row, $ruleKey = null)
	{
		$table = $this->getDbTable();
		$select = $table->select(false)->from($table->info("name"), $table->info("primary"));
		$results = $row->findDependentRowset(get_class($table), $ruleKey, $select);
		return $this->_loadByPrimaryKeys($results);
	}

	/**
	 * Finds primary keys of many to many rows
	 *
	 * @param \Zend_Db_Table_Row $row
	 * @param string $matchTable
	 * @param string $intersectionTable
	 * @param string $calleRefRule
	 * @param string $matcherRefRule
	 * @return array
	 */
	public function findManyToManyRowset(
		\Zend_Db_Table_Row $row,
		$matchTable,
		$intersectionTable,
		$callRefRule = null,
		$matchRefRule = null)
	{
		$table = $this->getDbTable();
// 		TODO only primary keys
		$select = $table->select(false)->from($table->info("name"), $table->info("primary"));
		$results = $row->findManyToManyRowset($matchTable, $intersectionTable, $callRefRule, $matchRefRule);
		return $this->_loadByPrimaryKeys($results);
	}

	public function findParentRow(
		\Zend_Db_Table_Row $row,
		$parentTable,
		$ruleKey = null)
	{
		$table = $this->getDbTable();
		$select = $table->select(false)->from($table->info("name"), $table->info("primary"));
		$results = $row->findParentRow($parentTable, $ruleKey, $select);
		return $this->_loadByPrimaryKeys($results);
	}

	protected function _simpleMap($model, $row)
	{
		foreach ($row as $key => $value) {
			$key = preg_replace("/_(\w{1})/e", "ucfirst('$1')", $key);
			$model->$key = $value;
		}

		return $model;
	}

	public function save(\Application\Entity\Entity $model)
	{
		if ($model->getIdentifier() == null) {
			$this->_doInsert($model);
		} else {
			$this->_doUpdate($model);
		}
	}

	public function delete(\Application\Entity\Entity $model)
	{
		return $this->_doDelete($model);
	}

	public function checkPrivileges($where, $field = "employee_id", $extra = null, $glue = "AND")
	{
		$employee = \Zend_Auth::getInstance()->getIdentity();
		$hasAdminGroup = false;
		if ($employee->employee_group_id) {
		    $em = \Application\Entity\EntityManager::getInstance();
		    $position = $em->find("EmployeePosition", $employee->employee_position_id);

		    if (strtolower($position->name) == "administrator") {
		        $hasAdminGroup = true;
		    }
		}

		if ($employee->super_admin != 1 && $hasAdminGroup == false) {
			$ids = \DataMapper\Employee::getChildren($employee->employee_id);
			if (in_array($employee->employee_id, $ids) == false) {
				$ids[] = $employee->employee_id;
			}

			$condition = $field . " IN (" . implode(',', $ids) . ")";

			if ($extra) {
				$condition .= " " . $glue . " " . $extra;
			}

			$where = $this->addCondition($condition, $where);
		}

		return $where;
	}
}