<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

/**
 * News Basic subform
 * @method News getModel() getModel()
 */
class News_SubForm_Basic extends \Application\Form\Subform
{
    public function init()
    {
        $element = $this->createElement("text", "title");
        $element->setRequired()
            ->addValidator(new Zend_Validate_StringLength(array("max" => 255)))
            ->addFilter(new Zend_Filter_StringTrim())
            ->setLabel("Tytuł")
            ->setValue($this->getModel()->title);
        $this->addElement($element);

        $element = $this->createElement("textarea", "text");
        $element->setLabel("Tekst")
            ->setValue($this->getModel()->text);
        $this->addElement($element);

        $element = $this->createElement("checkbox", "active");
        $element->setRequired()
            ->addValidator(new Zend_Validate_Int())
            ->setLabel("Aktywność")
            ->setChecked($this->getModel()->active);
        $this->addElement($element);

        $element = $this->createElement("text", "document");
        $element->setLabel("Plik")
            ->setValue($this->getModel()->attachment);
        $this->addElement($element);
    }
}