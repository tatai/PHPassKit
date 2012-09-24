<?php

namespace PHPassKit\Keys\LowerLevel;

class Barcode {
	/**
	 * @var string
	 */
	private $_format = null;

	/**
	 * @var string
	 */
	private $_message = null;

	/**
	 * @var string
	 */
	private $_encoding = null;

	/**
	 * @var string
	 */
	private $_alternate_text = null;

	public function __construct($format, $message, $encoding) {
		$this->_format = $format;
		$this->_message = $message;
		$this->_encoding = $encoding;
	}

	/**
	 * @return string
	 */
	public function getFormat() {
		return $this->_format;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->_message;
	}

	/**
	 * @return string
	 */
	public function getEncoding() {
		return $this->_encoding;
	}

	/**
	 * @param string $alternateText
	 */
	public function setAlternateText($alternateText) {
		$this->_alternate_text = $alternateText;
	}

	/**
	 * @return string
	 */
	public function getAlternateText() {
		return $this->_alternate_text;
	}
}