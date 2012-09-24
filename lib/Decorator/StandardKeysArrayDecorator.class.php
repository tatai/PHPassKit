<?php

namespace PHPassKit\Decorator;

use PHPassKit\Keys\FieldDictionary\StandardKeys;
use PHPassKit\Keys\FieldDictionary\TextAlignment;

class StandardKeysArrayDecorator {

	public function decorate(StandardKeys $keys) {
		$output = array(
			'key' => $keys->getKey(),
			'value' => $keys->getValue(),
		);

		$changeMessage = $keys->getChangeMessage();
		if(!is_null($changeMessage)) {
			$output['changeMessage'] = $changeMessage;
		}

		$label = $keys->getLabel();
		if(!is_null($label)) {
			$output['label'] = $label;
		}

		$textAlignment = $keys->getTextAlignment();
		if(!is_null($textAlignment)) {
			$output['textAlignment'] = TextAlignment::getConstName($textAlignment);
		}

		return $output;
	}
}