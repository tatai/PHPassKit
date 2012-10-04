<?php

namespace PHPassKit\Keys\FieldDictionary;

use PHPassKit\Keys\FieldDictionary\FieldDictionary;
use PHPassKit\Common\PHPassKitException;

class DateKeys extends FieldDictionary {
	/**
	 * @var int
	 */
	private $_value = null;

	/**
	 * @var int @see DateStyle
	 */
	private $_date_style = null;

	/**
	 * @var int @see DateStyle
	 */
	private $_time_style = null;

	/**
	 * @var boolean
	 */
	private $_is_relative = null;

	/**
	 * 
	 * @param string 	$key   @see FieldDictionary
	 * @param int 		$timestamp date in timestamp format
	 * @param string 	$label
	 *
	 * @throws  PHPassKitException
	 */
	public function __construct($key, $timestamp, $label = null) {
		parent::__construct($key, $label);

		if(!preg_match('/^[0-9]+$/', $timestamp)) {
			throw new PHPassKitException('Value given does not seem to be a timestamp');
		}

		$this->_value = (int)$timestamp;

		$this->_is_relative = false;
	}

	/**
	 * 
	 * @return int
	 */
	public function getValue() {
		return $this->_value;
	}

	/**
	 * @return int @see DateStyle
	 */
	public function getDateStyle() {
		return $this->_date_style;
	}

	/**
	 * @param int $style @see DateStyle
	 */
	public function setDateStyle($style) {
		$this->_date_style = $style;
	}

	/**
	 * @return int @see DateStyle
	 */
	public function getTimeStyle() {
		return $this->_time_style;
	}

	/**
	 * @param int $style @see DateStyle
	 */
	public function setTimeStyle($style) {
		$this->_time_style = $style;
	}

	/**
	 * @return boolean
	 */
	public function getIsRelative() {
		return $this->_is_relative;
	}

	/**
	 * @param boolean $isRelative
	 */
	public function setIsRelative($isRelative) {
		$this->_is_relative = $isRelative;
	}
}
