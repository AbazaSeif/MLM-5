<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Settlements_SubForm_Bonus extends Application\Form\Subform
{
    public function init()
    {
        $employee = $this->getModel()->employee->lastname . ' ' .
                    $this->getModel()->employee->firstname;
        $element = $this->createElement("text", "employee");
        $element->setAttrib("disabled", "disabled")
            ->setLabel("Pracownik")
            ->setValue($employee);
        $this->addElement($element);

        $element = $this->createElement("text", "create_date");
        $element->setAttrib("disabled", "disabled")
            ->setLabel("Data utworzenia")
            ->setValue($this->getModel()->createDate);
        $this->addElement($element);

        $element = $this->createElement("text", "total");
        $element->setAttrib("disabled", "disabled")
            ->setLabel("Kwota")
            ->setValue($this->getModel()->settlementTotal->total);
        $this->addElement($element);

        $element = $this->createElement("text", "parts");
        $element->setRequired()
            ->addFilter(new Zend_Filter_StringTrim())
            ->addValidator(new Zend_Validate_StringLength(array("min" => 0, "max" => 255)))
            ->setLabel("Tytuł");
        $this->addElement($element);

        $element = $this->createElement("text", "amount");
        $element->setRequired()
            ->setLabel("Premia");
        $this->addElement($element);
    }
}