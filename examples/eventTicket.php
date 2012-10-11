<?php
include_once(__DIR__ . '/../src/Autoload.php');

use PHPassKit\Common\PHPassKit;
use PHPassKit\Common\Factory;
use PHPassKit\Style\EventTicket;
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

// We want a passkit with EventTicket style
$eventTicket = new EventTicket();

// Primary fields: event description
$eventTicket->addKeys('primary', new StandardKeys('event', 'The Beat Goes On', 'EVENT'));

// Secondary fields: location
$eventTicket->addKeys('secondary', new StandardKeys('loc', 'Moscone West', 'LOCATION'));

// Back fields: terms and conditions
$eventTicket->addKeys('back', new StandardKeys('terms', file_get_contents(__DIR__ . '/data/EventTicket/terms-and-conditions.txt'), 'TERMS AND CONDITIONS'));



/*
 * PHPassKit creation
 */
$passKit = new PHPassKit('The Beat Goes On', 'Apple Inc.', $passTypeIdentifier, 'nmyuxofgnb', $teamIdentifier);

// Icon and logo
$passKit->addFile(__DIR__ . '/data/EventTicket/icon.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/icon@2x.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/logo.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/logo@2x.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/background.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/background@2x.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/thumbnail.png');
$passKit->addFile(__DIR__ . '/data/EventTicket/thumbnail@2x.png');

// Visualization
$passKit->setForegroundColor(255, 255, 255);
$passKit->setBackgroundColor(60, 65, 76);

// Relevant date
$passKit->setRelevantDate(1323378000);

// Barcode
$passKit->setBarcode(new Barcode(BarcodeFormat::PDF417, '123456789', 'iso-8859-1'));

// Locations
$passKit->addLocation(new Location(37.6189722, -122.3748889));
$passKit->addLocation(new Location(37.33182, -122.03118));

// Web service url and token
$passKit->setWebService('https://example.com/passes', 'vxwxd7J8AlNNFPS8k0a0FfUFtq0ewzFdc');

// EventTicket is set as style
$passKit->setStyle($eventTicket);



$output = $outputPasskitPath . DIRECTORY_SEPARATOR . 'EventTicket.pkpass';
$signature = new Signature($certificateFilePath, $certificatePassword, new Pkcs12());
if(Factory::builder()->create($passKit, $output, $signature) !== false) {
	print 'PassKit successfully created at ' . $output . "\n";
}
