<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\FieldDictionaryArrayDecorator;
use PHPassKit\Keys\FieldDictionary\StandardKeys;
use PHPassKit\Keys\FieldDictionary\TextAlignment;

class StandardKeysArrayDecorator extends FieldDictionaryArrayDecorator {

	public function decorate(StandardKeys $keys) {
		$output = parent::decorate($keys);

		$output['value'] = $keys->getValue();

		return $output;
	}
}