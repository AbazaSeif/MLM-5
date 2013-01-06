<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class CustomerOldProduct extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\CustomerOldProducts";

	protected function _doCreate()
	{
		$em = EntityManager::getInstance();
		$model = new \Model\CustomerOldProduct();
		$model->customer = new \Model\Customer();
		$model->institution = $em->create("Institution");
		$model->institutionProduct = $em->create("InstitutionProduct");
		$model->instruction = $em->create("Instruction");
		$model->premiumType = new \Model\PremiumType();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$row = $this->getDbTable()->find($id)->current();
		$model = new \Model\CustomerOldProduct();
		$this->_simpleMap($model, $row);
		$model->customer = $em->find("Customer", $row['customer_id']);
		$model->institution = $em->find("Institution", $row['institution_id']);
		$model->institutionProduct = $em->find("InstitutionProduct", $row['institution_product_id']);
		$model->instruction  = $em->find("Instruction", $row['instruction_id']);
		if(empty($row['premium_type_id'])) {
			$model->premiumType = $em->create("PremiumType");
		} else {
			$model->premiumType = $em->find("PremiumType", $row['premium_type_id']);
		}
		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"institution_id" => $model->institution->getIdentifier(),
			"institution_product_id" => $model->institutionProduct->getIdentifier(),
			"instruction_id" => $model->instruction->getIdentifier(),
			"insurance_sum" => $model->insuranceSum,
			"insurance_sum_nnw" => $model->insuranceSumNnw,
			"insurance_sum_nkw" => $model->insuranceSumNkw,
			"conclusion_date_start" => $model->conclusionDateStart,
			"conclusion_date_end" => $model->conclusionDateEnd,
			"fee" => $model->fee,
			"contribution" => $model->contribution,
			"amount" => $model->amount,
			"product_create_date" => $model->createDate,
			"policy_number" => $model->policyNumber,
			"description" => $model->description
		);

		if ($model->premiumType) {
			$data['premium_type_id'] = $model->premiumType->getIdentifier();
		}

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"institution_id" => $model->institution->getIdentifier(),
			"institution_product_id" => $model->institutionProduct->getIdentifier(),
			"instruction_id" => $model->instruction->getIdentifier(),
			"insurance_sum" => $model->insuranceSum,
			"insurance_sum_nnw" => $model->insuranceSumNnw,
			"insurance_sum_nkw" => $model->insuranceSumNkw,
			"conclusion_date_start" => $model->conclusionDateStart,
			"conclusion_date_end" => $model->conclusionDateEnd,
			"fee" => $model->fee,
			"contribution" => $model->contribution,
			"amount" => $model->amount,
			"product_create_date" => $model->createDate,
			"policy_number" => $model->policyNumber,
			"description" => $model->description
		);

		if ($model->premiumType) {
			$data['premium_type_id'] = $model->premiumType->getIdentifier();
		}

		$this->getDbTable()->update($data, "customer_old_product_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("customer_old_product_id = " . $model->getIdentifier());
	}
}