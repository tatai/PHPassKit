<?php
include_once(__DIR__ . '/../src/Autoload.php');

use PHPassKit\Common\PHPassKit;
use PHPassKit\Common\Factory;
use PHPassKit\Style\StoreCard;
use PHPassKit\Keys\FieldDictionary\StandardKeys;
use PHPassKit\Keys\FieldDictionary\NumberKeys;
use PHPassKit\Keys\LowerLevel\Location;
use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\Keys\LowerLevel\BarcodeFormat;
use PHPassKit\Generator\Signature;
use PHPassKit\Certificate\Pkcs12;

include_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
if(strlen($passTypeIdentifier) == 0 || strlen($teamIdentifier) == 0 || strlen($certificateFilePath) == 0 || strlen($certificatePassword) == 0 || strlen($outputPasskitPath) == 0) {
	die('Please set the variables in ' . __DIR__ . DIRECTORY_SEPARATOR . 'config.php' . "\n");
}

// We want a passkit with StoreCard style
$storeCard = new StoreCard();

// Primary fields: balance
$balance = new NumberKeys('balance', 25);
$balance->setLabel('remaining balance');
$balance->setCurrencyCode('USD');
$storeCard->addKeys('primary', $balance);

// Auxiliary fields: level and usual
$storeCard->addKeys('auxiliary', new StandardKeys('level', 'Gold', 'LEVEL'));
$storeCard->addKeys('auxiliary', new StandardKeys('usual', 'Iced Mocha', 'THE USUAL'));

// Back fields: terms and conditions
$storeCard->addKeys('back', new StandardKeys('terms', file_get_contents(__DIR__ . '/data/StoreCard/terms-and-conditions.txt'), 'TERMS AND CONDITIONS'));



/*
 * PHPassKit creation
 */
$passKit = new PHPassKit('Store card', 'Bayroast Coffee', $passTypeIdentifier, 'p69f2J', $teamIdentifier);

// Icon and logo
$passKit->addFile(__DIR__ . '/data/StoreCard/icon.png');
$passKit->addFile(__DIR__ . '/data/StoreCard/icon@2x.png');
$passKit->addFile(__DIR__ . '/data/StoreCard/logo.png');
$passKit->addFile(__DIR__ . '/data/StoreCard/logo@2x.png');
$passKit->addFile(__DIR__ . '/data/StoreCard/strip.png');
$passKit->addFile(__DIR__ . '/data/StoreCard/strip@2x.png');

// Visualization
$passKit->setForegroundColor(255, 255, 255);
$passKit->setBackgroundColor(118, 74, 50);

// Relevant date
$passKit->setRelevantDate(1323378000);

// Barcode
$passKit->setBarcode(new Barcode(BarcodeFormat::PDF417, '123456789', 'iso-8859-1'));

// Locations
$passKit->addLocation(new Location(37.6189722, -122.3748889));

// Web service url and token
$passKit->setWebService('https://example.com/passes', 'vxwxd7J8AlNNFPS8k0a0FfUFtq0ewzFdc');

// StoreCard is set as style
$passKit->setStyle($storeCard);



$output = $outputPasskitPath . DIRECTORY_SEPARATOR . 'StoreCard.pkpass';
$signature = new Signature($certificateFilePath, $certificatePassword, new Pkcs12());
if(Factory::builder()->create($passKit, $output, $signature) !== false) {
	print 'PassKit successfully created at ' . $output . "\n";
}
