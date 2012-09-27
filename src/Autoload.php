<?php
namespace PHPassKit;

function Autoloader($class = null) {
	$parts = explode('\\', $class);

	$namespace = $parts[0];

	if($namespace != __NAMESPACE__) {
		return false;
	}

	$path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
	if(file_exists(($path))) {
		return include_once($path);
	}
}

spl_autoload_register(__NAMESPACE__ . '\Autoloader');
