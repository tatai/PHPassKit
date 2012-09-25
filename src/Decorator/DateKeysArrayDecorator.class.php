<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\FieldDictionaryArrayDecorator;
use PHPassKit\Keys\FieldDictionary\DateKeys;
use PHPassKit\Keys\FieldDictionary\DateStyle;

class DateKeysArrayDecorator extends FieldDictionaryArrayDecorator {
	public function decorate($dateKeys) {
		$output = parent::decorate($dateKeys);

		$output['isRelative'] = $dateKeys->getIsRelative();
		$output['value'] = date('c', $dateKeys->getValue());

		$dateStyle = $dateKeys->getDateStyle();
		if(!is_null($dateStyle)) {
			$output['dateStyle'] = \PHPassKit\Keys\FieldDictionary\DateStyle::getConstName($dateStyle);
		}

		$timeStyle = $dateKeys->getTimeStyle();
		if(!is_null($timeStyle)) {
			$output['timeStyle'] = \PHPassKit\Keys\FieldDictionary\DateStyle::getConstName($timeStyle);
		}

		return $output;
	}
}
