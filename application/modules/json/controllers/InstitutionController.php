<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Model\Collection\Collection;

use Application\Entity\EntityManager;

class Json_InstitutionController extends \Zend_Controller_Action
{
	public function getProductsAction()
	{
		$institutionId = $this->getRequest()->getParam("id");
		$entityManager = EntityManager::getInstance();
		$products = $entityManager->findAllActive("InstitutionProduct", "institution_id = " . $institutionId);
		$data = Collection::toArray($products);

		echo Zend_Json::encode($data);
	}
}