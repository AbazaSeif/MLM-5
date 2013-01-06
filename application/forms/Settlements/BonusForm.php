<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Settlements_BonusForm extends Application\Form\Form
{
    public function init()
    {
        $bonus = new Settlements_SubForm_Bonus($this->getModel());
        $bonus->setLegend("Dane podstawowe");
        $this->addSubForm($bonus, "basic");
    }
}