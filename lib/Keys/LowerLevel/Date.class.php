<?php

namespace PHPassKit\Keys\LowerLevel;

class Date {

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

	public function __construct() {
		$this->_is_relative = false;
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
