<?php

// set error reporting high
error_reporting(E_ALL | E_STRICT);

// make sure we see them
ini_set('display_errors', 'On');

require_once dirname(__DIR__) . '/src/Apache/Solr/Autoload.php';
\Apache\Solr\Autoload::register();

// include composer autoload
$composerAutoload = dirname(__DIR__) . '/vendor/.composer/autoload.php';
if (!file_exists($composerAutoload)) {
    die("Missing '{$composerAutoload}', please run `php composer.phar install` to get vendors.");
}
require $composerAutoload;

// set up an autoload for Zend / Pear style class loading
spl_autoload_register(
	function($class)
	{
		include(str_replace("_", DIRECTORY_SEPARATOR, $class) . ".php");
	}
);
