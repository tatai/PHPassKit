<?php

namespace PHPassKit\Decorator;

use PHPassKit\FieldDictionaryKeys\StandardKeys;
use PHPassKit\FieldDictionaryKeys\TextAlignment;

class StandardKeysArrayDecorator {
	/**
	 * @var StandardKeys
	 */
	private $_keys = null;

	public function __construct(StandardKeys $keys) {
		$this->_keys = $keys;
	}

	public function decorate() {
		$output = array(
			'key' => $this->_keys->getKey(),
			'value' => $this->_keys->getValue(),
		);

		$changeMessage = $this->_keys->getChangeMessage();
		if(!is_null($changeMessage)) {
			$output['changeMessage'] = $changeMessage;
		}

		$label = $this->_keys->getLabel();
		if(!is_null($label)) {
			$output['label'] = $label;
		}

		$textAlignment = $this->_keys->getTextAlignment();
		if(!is_null($textAlignment)) {
			$output['textAlignment'] = TextAlignment::getConstName($textAlignment);
		}

		return $output;
	}
}