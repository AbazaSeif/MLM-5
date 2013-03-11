<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

class Employees_SubForm_Training extends \Application\Form\Subform
{
	public function init()
	{
		$em = \Application\Entity\EntityManager::getInstance();

		$trainings = $em->findAllActive("Training");
		$element = $this->createElement("select", "training");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setLabel("Szkolenie")
			->setValue($this->getModel()->training->getIdentifier())
			->setMultiOptions($this->getMultiOptions($trainings, "title"));
		$this->addElement($element);

		$element = $this->createElement("text", "date");
		$element->setRequired()
			->setLabel("Data")
			->setValue($this->getModel()->createDate);
		$this->addElement($element);

		$element = $this->createElement("text", "mark");
		$element->setRequired()
			->addValidator(new Zend_Validate_Float(array('locale' => 'en_US')))
			->setLabel("Ocena")
			->setValue($this->getModel()->mark);
		$this->addElement($element);

		$examiners = array();
		$employees = $em->findAllActive("Employee");
		$groupsOut = array("Administracja", "Doradcy Klienta", "Telemarketing");

		foreach ($employees as $index => $employee) {
		    if (!in_array($employee->group->name, $groupsOut)) {
		        $examiners[] = $employee;
		    }
		}

		$element = $this->createElement("select", "examiner");
		$element->setRequired()
			->addValidator("Int")
			->addFilter(new Zend_Filter_Null())
			->setMultiOptions($this->getMultiOptions($examiners, array("lastname", "firstname")))
			->setLabel("Egzaminator")
			->setValue($this->getModel()->examiner->getIdentifier());
		$this->addElement($element);
	}
}