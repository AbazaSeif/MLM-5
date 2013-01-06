<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Entity;

/**
 * Entity Manager
 */
class EntityManager
{
	private static $_instance;
	private static $_dataMappers = array();

	private function __construct() {}
	private function __clone() {}

	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function create($entityClass)
	{
		$dataMapper = $this->getDataMapper($entityClass);
		return $dataMapper->create();
	}

	public function find($entityClass, $id)
	{
		$dataMapper = $this->getDataMapper($entityClass);
		return $dataMapper->load($id);
	}

	/**
	 * @param string $entityClass
	 * @return \Application\DataMapper\DataMapper
	 */
	public function getDataMapper($entityClass)
	{
		if (!isset(self::$_dataMappers[$entityClass])) {
			$class = "\DataMapper\\" . $entityClass;
			self::$_dataMappers[$entityClass] = new $class();
		}

		return self::$_dataMappers[$entityClass];
	}

	/**
	 * @param string $entityClass
	 * @return Entity[]
	 */
	public function findAll($entityClass, $where = null)
	{
		$dataMapper = $this->getDataMapper($entityClass);
		return $dataMapper->loadAll(null, null, $where);
	}

	/**
	 * @param string $entityClass
	 * @return Entity[]
	 */
	public function findAllActive($entityClass, $where = null)
	{
		$dataMapper = $this->getDataMapper($entityClass);
		return $dataMapper->loadAllActive(null, null, $where);
	}

	public function __call($method, $args)
	{
		if (preg_match("/(find(?:All)?|create)([A-Z]{1}\w+)/", $method, $match)) {
			array_unshift($args, $match[2]);
			return call_user_func_array(array($this, $match[1]), $args);
		}

		return null;
	}

	public function persist(Entity $model)
	{
		$dataMapper = $this->getDataMapper($this->getEntityClassName($model));
		$dataMapper->save($model);
	}

	public function getEntityClassName(Entity $model)
	{
		$className = get_class($model);
		return basename(str_replace("\\", "/", $className));
	}

	public function delete(Entity $model)
	{
		$dataMapper = $this->getDataMapper($this->getEntityClassName($model));
		$dataMapper->delete($model);
	}
}