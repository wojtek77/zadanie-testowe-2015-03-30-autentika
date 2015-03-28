<?php

function v($v)
{
	echo '<pre>';
	print_r($v);
	echo '</pre>';
}
function vv($v)
{
	//echo '<pre>';
	var_dump($v);
	//echo '</pre>';
}
function vvv($var, & $result = null, $is_view = true)
{
	if (is_array($var) || is_object($var))
		foreach ($var as $key => $value)
			vvv($value, $result[$key], false);
	else
		$result = $var;
	
	if ($is_view)
	{
		echo '<pre>';
		print_r($result);
		echo '</pre>';
	}
}

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../../_frameworks/Zend/library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();