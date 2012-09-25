<?php

namespace PHPassKit\Decorator;

use PHPassKit\Keys\FieldDictionary\FieldDictionary;

abstract class FieldDictionaryArrayDecorator {

	public function decorate($keys) {
		$output = array(
			'key' => $keys->getKey()
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
			$output['textAlignment'] = \PHPassKit\Keys\FieldDictionary\TextAlignment::getConstName($textAlignment);
		}

		return $output;
	}

}