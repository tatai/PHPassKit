#!/bin/bash

if [ -e "phpunit.xml" ]; then
	php test/phpunit-wrapper.php --configuration phpunit.xml
else
	echo "Cannot find phpunit.xml"
fi
