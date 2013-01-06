<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class News_Form extends \Application\Form\Form
{
    public function init()
    {
        $basic = new News_SubForm_Basic($this->getModel());
        $basic->setEnctype("multipart/form-data");
        $basic->setLegend("Dane podstawowe");
        $this->addSubForm($basic, "basic");

        $groups = new News_SubForm_Groups($this->getModel());
        $groups->setLegend("Grupy");
        $this->addSubForm($groups, "groups");
    }
}