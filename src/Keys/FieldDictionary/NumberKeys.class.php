<?php

namespace PHPassKit\Keys\FieldDictionary;

use PHPassKit\Keys\FieldDictionary\FieldDictionary;
use PHPassKit\Common\PHPassKitException;

class NumberKeys extends FieldDictionary {
	/**
	 * @var int
	 */
	private $_value = null;

	/**
	 * @var string ISO 4217 currency code
	 */
	private $_currency_code = null;

	/**
	 * @var int @see NumberStyle
	 */
	private $_number_style = null;

	/**
	 * 
	 * @param string $key   @see FieldDictionary
	 * @param int $value
	 *
	 * @throws  PHPassKitException
	 */
	public function __construct($key, $value) {
		parent::__construct($key);

		if(!is_int($value) && !is_float($value)) {
			throw new PHPassKitException('Value given does not seem to be a valid number');
		}

		$this->_value = $value;
	}

	/**
	 * 
	 * @return number
	 */
	public function getValue() {
		return $this->_value;
	}

	/**
	 * @return string ISO 4217 currency code
	 */
	public function getCurrencyCode() {
		return $this->_currency_code;
	}

	/**
	 * @param number $currencyCode ISO 4217 currency code
	 */
	public function setCurrencyCode($currencyCode) {
		$this->_currency_code = $currencyCode;
	}

	/**
	 * @return int @see NumberStyle
	 */
	public function getNumberStyle() {
		return $this->_number_style;
	}

	/**
	 * @param int $style @see NumberStyle
	 */
	public function setNumberStyle($style) {
		$this->_number_style = $style;
	}

}
