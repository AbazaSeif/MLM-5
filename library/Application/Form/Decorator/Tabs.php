<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Form\Decorator;

/**
 * Tabs decorator
 */
class Tabs extends \Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$tabs = $this->getTabs($this->getElement());
		$activeTab = $this->getActiveTab($this->getElement());

		$xhtml = "<ul class='tabs'>";
		foreach ($tabs as $tab) {
			$cssClass = $tab->getAttrib("class");
			if ($activeTab && $tab->getName() == $activeTab) {
				$cssClass .= " active";
			}

			$xhtml .= "<li class='" . $cssClass . "'>"
				."<a href='#" . $tab->getName() ."'>&raquo; " . $tab->getLegend() . "</a>"
				. "</li>";
		}
		$xhtml .= "</ul>";

		return $xhtml . $content;
	}

	public function getTabs(\Application\Form\Form $form)
	{
		$subForms = $this->getElement()->getSubForms();
		$additionalTabs = $this->getElement()->getTabs();

		return array_merge($subForms, $additionalTabs);
	}

	public function getActiveTab(\Zend_Form $form)
	{
		$errors = $form->getMessages();
		if (!empty($errors)) {
			return preg_replace("/[^\w]/", "", array_shift(array_keys($errors)));
		}

		return null;
	}
}