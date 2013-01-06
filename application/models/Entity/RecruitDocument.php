<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Entity;

/**
 * Recruit document entity
 *
 * @property Recruit recruit
 * @property Document document
 */
class RecruitDocument extends \Application\Entity\Entity
{
	/**
	 * @var Recruit
	 */
	protected $_recruit;

	/**
	 * @var Document
	 */
	protected $_document;
}