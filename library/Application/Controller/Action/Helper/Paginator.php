<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Controller\Action\Helper;

use \Application\Paginator\Adapter\DataMapper;

class Paginator extends \Zend_Controller_Action_Helper_Abstract
{
	const DEFAULT_PAGE = 1;
	const DEFAULT_ITEM_COUNT_PER_PAGE = 15;
	const DEFAULT_SORT = null;
	const DEFAULT_ORDER = "asc";
	const ADDITIONAL_ORDER = "desc";

	public function paginate($entityClass, $where = null)
	{
		$request = $this->getRequest();
		$pageNumber = $request->getParam("page", self::DEFAULT_PAGE);
		$itemCountPerPage = $request->getParam("items", self::DEFAULT_ITEM_COUNT_PER_PAGE);
		$order = $request->getParam("order", self::DEFAULT_ORDER);
		$sort = $request->getParam("sort", self::DEFAULT_SORT);
		if (!empty($sort)) {
			$sort = explode(',', $sort);
		}

		$paginatorAdapter = new DataMapper($entityClass, $where, $sort, $order);

		$temp = ucfirst(preg_replace("/-(\w{1})/e", "ucfirst('$1')", $request->getControllerName()));
		$filename = APPLICATION_PATH . "/filters/" . $temp . ".php";

		if (file_exists($filename)) {
			$filterName = "\Filter_" . $temp;
			$filter = new $filterName();
			$paginatorAdapter->setFilter($filter);
		}

		$paginator = new \Zend_Paginator($paginatorAdapter);
		$paginator->setCurrentPageNumber($pageNumber);
		$paginator->setItemCountPerPage($itemCountPerPage);
		$this->getActionController()->view->paginator = $paginator;
	}
}