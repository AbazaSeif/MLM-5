<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

use \Application\Entity\EntityManager;

/**
 * News Basic subform
 * @method News getModel() getModel()
 */
class News_SubForm_Groups extends \Application\Form\Subform
{
    public function init()
    {
        $em = EntityManager::getInstance();
        $groups = $em->findAllActive("EmployeeGroup");

        $modelGroups = array();
        foreach ($this->getModel()->groups as $group) {
            $modelGroups[] = $group->group->getIdentifier();
        }

        $element = $this->createElement("multiCheckbox", "group");
        $element->setRequired()
            ->addValidator(new Zend_Validate_Int())
            ->setMultiOptions($this->getMultiOptions($groups, "name", false))
            ->setValue($modelGroups);
        $this->addElement($element);
    }
}