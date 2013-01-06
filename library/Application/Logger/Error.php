<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Logger;

class Error
{
	/**
	 * @var \Zend_Log
	 */
	private $_log;
	private $_fatalErrors = array(E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR);

	public function __construct(\Zend_Log $log)
	{
		$this->_log = $log;

		set_exception_handler(array($this, 'exceptionHandler'));
		set_error_handler(array($this, 'errorHandler'));
		register_shutdown_function(array($this, 'fatalErrorHandler'));

		error_reporting(E_ALL | E_STRICT);
	}

	/**
	 * @return \Zend_Log
	 */
	public function getLog()
	{
		return $this->_log;
	}

	/**
	 * @param Exception $exception
	 */
	public function exceptionHandler(Exception $exception)
	{
		$this->getLog()->log($exception, \Zend_Log::ERR);
	}

	/**
	 * @param int	 	$errorNo
	 * @param string 	$error
	 * @param string 	$file
	 * @param int 		$line
	 */
	public function errorHandler($errorNo, $error, $file, $line)
	{
		$this->getLog()->log("Error: " . $error . " in " . $file . " on line ". $line . "\n", \Zend_Log::ERR);
	}

	public function fatalErrorHandler()
	{
		$error = error_get_last();
		if ($error && in_array($error['type'], $this->_fatalErrors)) {
			$this->getLog()
				->log("Error: " . $error['message'] . " in " . $error['file'] . " on line ". $error['line'] . "\n", \Zend_Log::ERR);
		}
	}
}