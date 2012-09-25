<?php
namespace PHPassKit;

function Autoloader($class = null) {
	$parts = explode('\\', $class);

	$namespace = array_shift($parts);

	if($namespace != __NAMESPACE__) {
		return false;
	}

	$path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts) . '.class.php';
	if(file_exists(($path))) {
		return include_once($path);
	}
}

spl_autoload_register(__NAMESPACE__ . '\Autoloader');
