<?php

namespace PHPassKit\Keys\FieldDictionary;

use PHPassKit\Keys\FieldDictionary\FieldDictionary;
use PHPassKit\PHPassKitException;

class StandardKeys extends FieldDictionary {
	/**
	 * @var string
	 */
	private $_value = null;

	/**
	 * 
	 * @param string	$key
	 * @param string	$value
	 *
	 * @throws  PHPassKitException
	 */
	public function __construct($key, $value) {
		parent::__construct($key);

		if(!is_string($value)) {
			throw new PHPassKitException('Value given does not seem to be a string');
		}

		$this->_value = $value;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->_value;
	}

}