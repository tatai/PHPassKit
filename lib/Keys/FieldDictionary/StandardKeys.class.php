<?php

namespace PHPassKit\Keys\FieldDictionary;

class StandardKeys {
	/**
	 * @var string
	 */
	private $_key = null;

	/**
	 * @var string
	 */
	private $_value = null;

	/**
	 * @var string
	 */
	private $_change_message = null;
	
	/**
	 * @var string
	 */
	private $_label = null;

	/**
	 * @var int
	 */
	private $_text_alignment = null;

	/**
	 * 
	 * @param string	$key
	 * @param string	$value
	 */
	public function __construct($key, $value) {
		$this->_key = $key;
		$this->_value = $value;
	}

	/**
	 * @return string
	 */
	public function getKey() {
		return $this->_key;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->_value;
	}

	/**
	 * @return string
	 */
	public function getChangeMessage() {
		return $this->_change_message;
	}

	/**
	 * @param string $changeMessage
	 */
	public function setChangeMessage($changeMessage) {
		$this->_change_message = $changeMessage;
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->_label;
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label) {
		$this->_label = $label;
	}

	/**
	 * @return int
	 */
	public function getTextAlignment() {
		return $this->_text_alignment;
	}

	/**
	 * @param int $textAlignment
	 */
	public function setTextAlignment($textAlignment) {
		$this->_text_alignment = $textAlignment;
	}
}