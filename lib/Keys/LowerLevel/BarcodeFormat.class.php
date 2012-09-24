<?php

namespace PHPassKit\Keys\LowerLevel;

class BarcodeFormat {
	const QR 		= 1;
	const PDF417 	= 2;
	const AZTEC 	= 4;

	static public function getConstName($format) {
		switch ($format) {
			case BarcodeFormat::QR:
				return 'PKBarcodeFormatQR';
				break;
			case BarcodeFormat::PDF417:
				return 'PKBarcodeFormatPDF417';
				break;
			case BarcodeFormat::AZTEC:
				return 'PKBarcodeFormatAztec';
				break;
		}
	}

}