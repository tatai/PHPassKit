<?php
include_once(__DIR__ . '/../src/Autoload.php');

use PHPassKit\Common\PHPassKit;
use PHPassKit\Common\Factory;
use PHPassKit\Style\Generic;
use PHPassKit\Keys\FieldDictionary\StandardKeys;
use PHPassKit\Keys\FieldDictionary\TextAlignment;
use PHPassKit\Keys\FieldDictionary\NumberKeys;
use PHPassKit\Keys\FieldDictionary\NumberStyle;
use PHPassKit\Keys\FieldDictionary\DateKeys;
use PHPassKit\Keys\FieldDictionary\DateStyle;
use PHPassKit\Keys\LowerLevel\Location;
use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\Keys\LowerLevel\BarcodeFormat;
use PHPassKit\Generator\Signature;
use PHPassKit\Certificate\Pkcs12;

include_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
if(strlen($passTypeIdentifier) == 0 || strlen($teamIdentifier) == 0 || strlen($certificateFilePath) == 0 || strlen($certificatePassword) == 0 || strlen($outputPasskitPath) == 0) {
	die('Please set the variables in ' . __DIR__ . DIRECTORY_SEPARATOR . 'config.php' . "\n");
}

// We want a passkit with Generic style
$generic = new Generic();

// Primary fields: member name
$generic->addKeys('primary', new StandardKeys('member', 'Johnny Appleseed'));

// Secondary fields: subtitle
$generic->addKeys('secondary', new StandardKeys('subtitle', '2012', 'MEMBER SINCE'));

// Auxiliary fields: level and favourite
$generic->addKeys('auxiliary', new StandardKeys('level', 'Platinum', 'LEVEL'));
$favourite = new StandardKeys('favourite', 'Trucks', 'FAVORITE TOY');
$favourite->setTextAlignment(TextAlignment::RIGHT);
$generic->addKeys('auxiliary', $favourite);

// Back fields: various data
$number = new NumberKeys('numberStyle', 200, 'spelled out');
$number->setNumberStyle(NumberStyle::SPELLOUT);
$generic->addKeys('back', $number);
$generic->addKeys('back', new StandardKeys('loc', 'Oh my stars.', 'localized to french'));
$currency = new NumberKeys('currency', 200, 'in reals');
$currency->setCurrencyCode('BRL');
$generic->addKeys('back', $currency);

$dateFull = new DateKeys('dateFull', 326559600, 'date full');
$dateFull->setDateStyle(DateStyle::FULL);
$generic->addKeys('back', $dateFull);

$timeFull = new DateKeys('timeFull', 326559600, 'time full');
$timeFull->setTimeStyle(DateStyle::FULL);
$generic->addKeys('back', $timeFull);

$dateTime = new DateKeys('dateTime', 326559600, 'dateTime');
$dateTime->setDateStyle(DateStyle::SHORT);
$dateTime->setTimeStyle(DateStyle::SHORT);
$generic->addKeys('back', $dateTime);

$relStyle = new DateKeys('relStyle', 1335279600, 'rel style');
$relStyle->setDateStyle(DateStyle::SHORT);
$relStyle->setIsRelative(true);
$generic->addKeys('back', $relStyle);


/*
 * PHPassKit creation
 */
$passKit = new PHPassKit('Membership card', 'Toy Town', $passTypeIdentifier, 'nmyuxofgnb2', $teamIdentifier);

// Icon and logo
$passKit->addFile(__DIR__ . '/data/Generic/icon.png');
$passKit->addFile(__DIR__ . '/data/Generic/icon@2x.png');
$passKit->addFile(__DIR__ . '/data/Generic/logo.png');
$passKit->addFile(__DIR__ . '/data/Generic/logo@2x.png');
$passKit->addFile(__DIR__ . '/data/Generic/thumbnail.png');
$passKit->addFile(__DIR__ . '/data/Generic/thumbnail@2x.png');
$passKit->setLogoText('Toy Town');

// Visualization
$passKit->setForegroundColor(255, 255, 255);
$passKit->setBackgroundColor(197, 31, 31);

// Barcode
$passKit->setBarcode(new Barcode(BarcodeFormat::PDF417, '123456789', 'iso-8859-1'));

// Locations
$passKit->addLocation(new Location(37.6189722, -122.3748889));
$passKit->addLocation(new Location(37.33182, -122.03118));

// Web service url and token
$passKit->setWebService('https://example.com/passes', 'vxwxd7J8AlNNFPS8k0a0FfUFtq0ewzFdc');

// Generic is set as style
$passKit->setStyle($generic);



$output = $outputPasskitPath . DIRECTORY_SEPARATOR . 'Generic.pkpass';
$signature = new Signature($certificateFilePath, $certificatePassword, new Pkcs12());
if(Factory::builder()->create($passKit, $output, $signature) !== false) {
	print 'PassKit successfully created at ' . $output . "\n";
}
