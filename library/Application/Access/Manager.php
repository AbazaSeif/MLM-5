<?php
/**
 * Access Manager
 *
 * PHP Version 5.3
 *
 * @category   Library
 * @package    Application
 * @subpackage Access
 * @author     Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright  2012 MLM System
 * @license    http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version    GIT: <git_id>
 * @link       http://mlm.osiris.net.pl
 * @since      File available since Release 1.0.0
 */
namespace Application\Access;

/**
 * Access Manager
 *
 * @category   Library
 * @package    Application
 * @subpackage Access
 * @author     Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright  2012 MLM System
 * @license    http://www.opensource.org/license/bsd-license.php BSD License
 * @version    Release: 1.0.0
 * @link       http://mlm.osiris.net.pl
 * @since      Class available since Release 1.0.0
 */
class Manager
{
    const MODULE_NEWS          = 0;
    const MODULE_CUSTOMERS     = 1;
    const MODULE_APPLICATIONS  = 2;
    const MODULE_EMPLOYEES     = 3;
    const MODULE_SETTLEMENTS   = 4;
    const MODULE_RECRUITMENTS  = 5;
    const MODULE_PARTNERS      = 6;
    const MODULE_PRODUCTS      = 7;
    const MODULE_CONFIGURATION = 8;

    const GRANT_OPTION		   = 9;

    const ACTION_NONE 	= 0;
    const ACTION_READ 	= 1;
    const ACTION_UPDATE = 2;
    const ACTION_DELETE = 4;

    public static function getModules()
    {
        return array(
            "news" 	        => "News",
        	"customers"		=> "Klienci",
            "applications" 	=> "Wnioski",
            "employees" 	=> "Pracownicy",
            "settlements" 	=> "Rozliczenia",
            "recruitments" 	=> "Rekrutacja",
            "partners" 		=> "Partnerzy",
            "products" 		=> "Produkty",
            "configuration" => "Konfiguracja"
        );
    }

    public static function getActions()
    {
    	return array(
    		0 => "Brak",
    		1 => "Odczytywanie",
    		2 => "Odczytywanie/Dodawanie/Edycja",
    		4 => "Odczytywanie/Dodawanie/Edycja/Usuwanie"
    	);
    }

    public static function hasAccess($action, $module, $values = null)
    {
    	if ($values == null) {
    	    $identity = \Zend_Auth::getInstance()->getIdentity();   	    
    		$values = $identity->access;
    	}

    	$value  = decbin(self::getValue($values, $module));
    	$action = decbin($action);

        return ($value & $action) == $action;
    }

    public static function hasGrantOption($values)
    {
    	return (bool)self::getValue($values, self::GRANT_OPTION);
    }

    public static function getValue($values, $module)
    {
    	return substr($values, $module, 1);
    }
}