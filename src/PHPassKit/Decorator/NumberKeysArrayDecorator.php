<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\FieldDictionaryArrayDecorator;
use PHPassKit\Keys\FieldDictionary\NumberKeys;
use PHPassKit\Keys\FieldDictionary\NumberStyle;

class NumberKeysArrayDecorator extends FieldDictionaryArrayDecorator {
	public function decorate($numberKeys) {
		$output = parent::decorate($numberKeys);

		$output['value'] = $numberKeys->getValue();

		$numberStyle = $numberKeys->getNumberStyle();
		if(!is_null($numberStyle)) {
			$output['numberStyle'] = \PHPassKit\Keys\FieldDictionary\NumberStyle::getConstName($numberStyle);
		}

		$currencyCode = $numberKeys->getCurrencyCode();
		if(!is_null($currencyCode)) {
			$output['currencyCode'] = $currencyCode;
		}

		return $output;
	}
}
