PHPassKit: easy passkit creation for iOS6 Passbook with PHP
===========================================================

Create your iOS 6 passkits with PHP.

Requirements
------------

* PHP 5.3
 * [OpenSSL support](http://php.net/openssl) enabled
 * [Zip support](http://php.net/zip) enabled

Installation
------------

Follow this steps:

1. Add PHPassKit to your project
 * Clone: `git clone https://github.com/tatai/PHPassKit.git PHPassKit`
 * Go to [downloads page](https://github.com/tatai/PHPassKit/downloads) and get the last version
2. Include `src/Autoload.php`
3. Follow examples and create your PassKits!

How to install PHPassKit in:

* [Symfony 2][symfony-doc]
* [symfony 1.4][symfony-doc]


Usage
-----

Please, get into `examples` folder where you have several examples of Passkits creation with PHPassKit.

Change whatever you want but remember to set values in `config.php`.

* [How can I get a certificate to sign passkits?](doc/certificates.md)
* [What is my passTypeIdentifier and my teamIdentifier?](doc/apple-identifiers.md)
* [FAQ](doc/faq.md)

Unit testing
------------

This project has been created using [PHPUnit 3.6](https://github.com/sebastianbergmann/phpunit/) for unit testing. To execute all tests, PHPUnit and some dependencies must be downloaded to phpunit folder. Follow this steps:

1. Execute `./install_phpunit.sh` to install PHPUnit and its dependencies
2. Execute `./executeTests.sh` to run all tests

Contributing
------------

Using [GitHub Pull Request](https://help.github.com/articles/using-pull-requests) method

1. Fork it
2. Create a branch (`git checkout -b my_feature`)
3. Commit your changes (`git commit -am "Added incredible new features"`)
4. Push to the branch (`git push origin my_feature`)
5. Open a [Pull Request](https://github.com/tatai/PHPassKit/pulls)
6. Enjoy and wait for response!

Support
-------

* fran.naranjo@gmail.com 
* Twitter: [@tatai](http://twitter.com/tatai)

[symfony-doc]: doc/symfony.md
