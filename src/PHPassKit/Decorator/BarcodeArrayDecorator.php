<?php

namespace PHPassKit\Decorator;

use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\Keys\LowerLevel\BarcodeFormat;

class BarcodeArrayDecorator {
	public function decorate(Barcode $barcode) {
		$output = array(
			'format' => BarcodeFormat::getConstName($barcode->getFormat()),
			'message' => $barcode->getMessage(),
			'messageEncoding' => $barcode->getEncoding()
		);

		$alternateText = $barcode->getAlternateText();
		if(!is_null($alternateText)) {
			$output['altText'] = $alternateText;
		}

		return $output;
	}
}