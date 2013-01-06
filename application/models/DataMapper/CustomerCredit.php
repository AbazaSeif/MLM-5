<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

use Application\Entity\EntityManager;

class CustomerCredit extends \Application\DataMapper\DataMapper
{
	protected $_dbTable = "DbTable\CustomerCredits";

	protected function _doCreate()
	{
		$model = new \Model\CustomerCredit();
		$model->type = new \Model\CreditType();
		$model->currency = new \Model\Currency();
		$model->customer = new \Model\Customer();

		return $model;
	}

	protected function _doLoad($id)
	{
		$em = EntityManager::getInstance();
		$model = new \Model\CustomerCredit();
		$row = $this->getDbTable()->find($id)->current();
		$this->_simpleMap($model, $row);
		$model->type = $em->find("CreditType", $row['credit_type_id']);
		$model->currency = $em->find("Currency", $row['currency_id']);
		$model->customer = $em->find("Customer", $row['customer_id']);

		return $model;
	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"credit_type_id" => $model->type->getIdentifier(),
			"bank" => $model->bank,
			"margin" => $model->margin,
			"rrso" => $model->rrso,
			"amount" => $model->amount,
			"currency_id" => $model->currency->getIdentifier(),
			"currency_rate" => $model->currencyRate,
			"installment" => $model->installment,
			"conclusion_date_start" => $model->conclusionDateStart,
			"period_in_months" => $model->periodInMonths,
			"balance" => $model->balance,
			"balance_date" => $model->balanceDate,
			"cost_of_repayment" => $model->costOfRepayment
		);

		$id = $this->getDbTable()->insert($data);
		$model->setIdentifier($id);
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{
		$data = array(
			"customer_id" => $model->customer->getIdentifier(),
			"credit_type_id" => $model->type->getIdentifier(),
			"bank" => $model->bank,
			"margin" => $model->margin,
			"rrso" => $model->rrso,
			"amount" => $model->amount,
			"currency_id" => $model->currency->getIdentifier(),
			"currency_rate" => $model->currencyRate,
			"installment" => $model->installment,
			"conclusion_date_start" => $model->conclusionDateStart,
			"period_in_months" => $model->periodInMonths,
			"balance" => $model->balance,
			"balance_date" => $model->balanceDate,
			"cost_of_repayment" => $model->costOfRepayment
		);

		$this->getDbTable()->update($data, "customer_credit_id = " . $model->getIdentifier());
	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{
		$this->getDbTable()->delete("customer_credit_id = " . $model->getIdentifier());
	}
}