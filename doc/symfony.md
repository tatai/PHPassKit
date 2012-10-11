Installing PHPassKit in Symfony
===============================

Symfony 2
---------

If you are using Symfony 2, you can use PHPassKit installing as vendor:

Add these lines to `deps`

	[PHPassKit]
	git=http://github.com/tatai/PHPassKit.git
	target=phpasskit

Change your application autoload to include PHPassKit files. Considering that your application is named `app`, then edit `app/autoload.php` and let it 

	$loader->registerNamespaces(array(
		// Other entries
		// ...
	    'PHPassKit' => __DIR__.'/../vendor/phpasskit/src'
	));

symfony 1.4
-----------

With symfony 1.4 within your project, create folder `lib/vendor/PHPassKit` and copy all PHPassKit files into it.

Then, add PHPassKit project to your autoload configuration. Update (or create) `config/autoload.yml` and create a new entry:

	autoload:
	  phpasskit:
	    name:      PHPassKit iOS6 Passbook library
	    path:      %SF_LIB_DIR%/vendor/PHPassKit/src/PHPassKit
	    recursive: true
