#!/usr/bin/env php
<?php

$dir = __DIR__ . '/../phpunit';
set_include_path(implode(PATH_SEPARATOR, array(
	$dir,
	$dir . '/php-file-iterator',
	$dir . '/php-text-template',
	$dir . '/php-code-coverage', 
	$dir . '/php-token-stream', 
	$dir . '/php-timer', 
	$dir . '/phpunit-mock-objects', 
	$dir . '/phpunit-selenium', 
	$dir . '/phpunit-story', 
	$dir . '/php-invoker', 
	get_include_path(), 
)));

include(dirname(__FILE__) . '/../phpunit/phpunit.php');
