<?php
include_once(__DIR__ . '/../src/Autoload.php');

use PHPassKit\Common\PHPassKit;
use PHPassKit\Common\Factory;
use PHPassKit\Style\BoardingPass;
use PHPassKit\Style\TransitType;
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

// We want a passkit with BoardingPass style
$boardingPass = new BoardingPass(TransitType::AIR);

// Header fields: gate description
$header = new StandardKeys('gate', '23');
$header->setLabel('GATE');
$header->setChangeMessage('Gate changed to %@');
$boardingPass->addKeys('header', $header);

// Primary fields: depart and arrive
$boardingPass->addKeys('primary', new StandardKeys('depart', 'SFO', 'SAN FRANCISCO'));
$boardingPass->addKeys('primary', new StandardKeys('arrive', 'JFK', 'NEW YORK'));

// Secondary fields: location
$boardingPass->addKeys('secondary', new StandardKeys('passenger', 'John Appleseed', 'PASSENGER'));

// Auxiliary fields: flight info
$boardingPass->addKeys('auxiliary', new StandardKeys('boardingTime', '2:25 PM', 'DEPART'));
$boardingPass->addKeys('auxiliary', new StandardKeys('flightNewName', '815', 'FLIGHT'));
$boardingPass->addKeys('auxiliary', new StandardKeys('class', 'Coach', 'DESIGN.'));
$boardingPass->addKeys('auxiliary', new StandardKeys('date', '7/22', 'DATE'));

// Back fields: passport, residence and terms
$boardingPass->addKeys('back', new StandardKeys('passport', 'Canadian/Canadien', 'PASSPORT'));
$boardingPass->addKeys('back', new StandardKeys('residence', '5780 E Mission St, San Jose, CA', 'RESIDENCE'));
$boardingPass->addKeys('back', new StandardKeys('terms', file_get_contents(__DIR__ . '/data/BoardingPass/terms-and-conditions.txt'), 'TERMS'));


/*
 * PHPassKit creation
 */
$passKit = new PHPassKit('SFO to JFK', 'Skyport Airways', $passTypeIdentifier, 'gT6zrHkaW', $teamIdentifier);

// Icon and logo
$passKit->addFile(__DIR__ . '/data/BoardingPass/icon.png');
$passKit->addFile(__DIR__ . '/data/BoardingPass/icon@2x.png');
$passKit->addFile(__DIR__ . '/data/BoardingPass/logo.png');
$passKit->addFile(__DIR__ . '/data/BoardingPass/logo@2x.png');
$passKit->setLogoText('Skyport Airways');

// Visualization
$passKit->setForegroundColor(22, 55, 110);
$passKit->setBackgroundColor(50, 91, 185);

// Relevant date
$passKit->setRelevantDate(1342995900);

// Barcode
$passKit->setBarcode(new Barcode(BarcodeFormat::PDF417, 'SFOJFK JOHN APPLESEED LH451 2012-07-22T14:25-08:00', 'iso-8859-1'));

// Locations
$passKit->addLocation(new Location(37.6189722, -122.3748889));

// Web service url and token
$passKit->setWebService('https://example.com/passes', 'vxwxd7J8AlNNFPS8k0a0FfUFtq0ewzFdc');

// BoardingPass is set as style
$passKit->setStyle($boardingPass);



$output = $outputPasskitPath . DIRECTORY_SEPARATOR . 'BoardingPass.pkpass';
$signature = new Signature($certificateFilePath, $certificatePassword, new Pkcs12());
if(Factory::builder()->create($passKit, $output, $signature) !== false) {
	print 'PassKit successfully created at ' . $output . "\n";
}

