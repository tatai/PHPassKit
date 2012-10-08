<?php
include_once(__DIR__ . '/../src/Autoload.php');

use PHPassKit\Common\PHPassKit;
use PHPassKit\Common\Factory;
use PHPassKit\Style\Coupon;
use PHPassKit\Keys\FieldDictionary\StandardKeys;
use PHPassKit\Keys\LowerLevel\Location;
use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\Keys\LowerLevel\BarcodeFormat;
use PHPassKit\Generator\Signature;
use PHPassKit\Certificate\Pkcs12;

include_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
if(strlen($passTypeIdentifier) == 0 || strlen($teamIdentifier) == 0 || strlen($certificateFilePath) == 0 || strlen($certificatePassword) == 0 || strlen($outputPasskitPath) == 0) {
	die('Please set the variables in ' . __DIR__ . DIRECTORY_SEPARATOR . 'config.php' . "\n");
}

// We want a passkit with Coupon style
$coupon = new Coupon();

// Primary fields: coupon description
$coupon->addKeys('primary', new StandardKeys('offer', '25% off', 'Any premium dog food'));

// Auxiliary fields: expiration date
$coupon->addKeys('auxiliary', new StandardKeys('expires', '2 weeks', 'EXPIRES'));

// Back fields: terms and conditions
$coupon->addKeys('back', new StandardKeys('terms', file_get_contents(__DIR__ . '/data/Coupon/terms-and-conditions.txt'), 'TERMS AND CONDITIONS'));


/*
 * PHPassKit creation
 */
$passKit = new PHPassKit('20% off premium dog food1', 'Paw Planet1', $passTypeIdentifier, 'E5982H-I21', $teamIdentifier);

// Icon and logo
$passKit->addFile(__DIR__ . '/data/Coupon/icon.png');
$passKit->addFile(__DIR__ . '/data/Coupon/icon@2x.png');
$passKit->addFile(__DIR__ . '/data/Coupon/logo.png');
$passKit->addFile(__DIR__ . '/data/Coupon/logo@2x.png');
$passKit->setLogoText('Paw Planet');

// Visualization
$passKit->setForegroundColor(255, 255, 255);
$passKit->setBackgroundColor(206, 140, 53);

// Barcode
$passKit->setBarcode(new Barcode(BarcodeFormat::PDF417, '123456789', 'iso-8859-1'));

// Locations
$passKit->addLocation(new Location(37.6189722, -122.3748889));
$passKit->addLocation(new Location(37.33182, -122.03118));

// Web service url and token
$passKit->setWebService('https://example.com/passes', 'vxwxd7J8AlNNFPS8k0a0FfUFtq0ewzFdc');

// Coupon is set as style
$passKit->setStyle($coupon);




$output = $outputPasskitPath . DIRECTORY_SEPARATOR . 'Coupon.pkpass';
$signature = new Signature($certificateFilePath, $certificatePassword, new Pkcs12());
if(Factory::builder()->create($passKit, $output, $signature) !== false) {
	print 'PassKit successfully created at ' . $output . "\n";
}
