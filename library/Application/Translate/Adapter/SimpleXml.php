<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Translate\Adapter;

class SimpleXML extends \Zend_Translate_Adapter
{
	protected function _loadTranslationData($filename, $locale, array $options = array())
	{
		$data = array(
			$locale => array()
		);
		$root = simplexml_load_file($filename);

		foreach ($root->children() as $child) {
			$key = $child->key->__toString();
			$translation = $child->value->__toString();

			$data[$locale][$key] = $translation;
		}

		return $data;
	}

	public function toString()
	{
		return "Xml";
	}
}