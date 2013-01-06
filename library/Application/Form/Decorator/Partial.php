<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Form\Decorator;

class Partial extends \Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$tabs = $this->getElement()->getTabs();
		$model = $this->getElement()->getModel();
		$partial = $this->getElement()->getView()->getHelper("partial");
		$partial->setObjectKey("model");

		foreach ($tabs as $tab) {
			$content .= "<fieldset id='fieldset-" . $tab->getName() . "'>" .
				"<legend>" . $tab->getLegend() . "</legend>" .
				$partial->partial($tab->getPartial(), $model) .
				"</fieldset>";
		}

		return $content;
	}
}