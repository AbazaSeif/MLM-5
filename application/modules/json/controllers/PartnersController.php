<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use Application\Model\Collection\Collection;

use Application\Entity\EntityManager;

class Json_PartnersController extends Zend_Controller_Action
{
	public function getProductsAction()
	{
		$partnerId = $this->getRequest()->getParam("id");
		$entityManager = EntityManager::getInstance();
		$products = $entityManager->findAllActive("Product", "partner_id = " . $partnerId);
		$data = Collection::toArray($products);

		echo Zend_Json::encode($data);
	}
}