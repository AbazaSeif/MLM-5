<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace DataMapper;

class Configuration extends \Application\DataMapper\DataMapper
{

	protected function _doCreate()
	{
		$filename = APPLICATION_PATH . "/configs/configuration.ini";
		$config = new \Zend_Config_Ini($filename);
		$model = new \Model\Configuration();
		$this->_simpleMap($model, $config);
		return $model;
	}

	protected function _doLoad($id)
	{

	}

	protected function _doInsert(\Application\Entity\Entity $model)
	{
		$data = array(
			"tax_free_allowance" => $model->taxFreeAllowance,
			"tax_percent" => $model->taxPercent,
			"incaso_parts" => $model->incasoParts,
			"storno_interval" => $model->stornoInterval,
			"storno_first_part_percent"	=> $model->stornoFirstPartPercent,
			"storno_second_part_percent" => $model->stornoSecondPartPercent
		);

		$filename = APPLICATION_PATH . "/configs/configuration.ini";
		$configWriter = new \Zend_Config_Writer_Ini();
		$configWriter->write($filename, new \Zend_Config($data));
	}

	protected function _doUpdate(\Application\Entity\Entity $model)
	{

	}

	protected function _doDelete(\Application\Entity\Entity $model)
	{

	}
}