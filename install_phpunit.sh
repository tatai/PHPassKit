#!/bin/bash

git clone -b 3.6 git://github.com/sebastianbergmann/phpunit.git

cd phpunit

git submodule init

git submodule add git://github.com/sebastianbergmann/dbunit.git
git submodule add git://github.com/sebastianbergmann/php-file-iterator.git
git submodule add git://github.com/sebastianbergmann/php-text-template.git
git submodule add git://github.com/sebastianbergmann/php-code-coverage.git
git submodule add git://github.com/sebastianbergmann/php-token-stream.git
git submodule add git://github.com/sebastianbergmann/php-timer.git
git submodule add git://github.com/sebastianbergmann/phpunit-mock-objects.git
git submodule add git://github.com/sebastianbergmann/phpunit-selenium.git
git submodule add git://github.com/sebastianbergmann/phpunit-story.git
git submodule add git://github.com/sebastianbergmann/php-invoker.git
