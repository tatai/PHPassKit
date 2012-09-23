<?php

namespace PHPassKit\Style;

use PHPassKit\FieldDictionaryKeys\StandardKeys;
use PHPassKit\PHPassKitException;

abstract class Style {
	/**
	 * @var array
	 */
	private $_fields = null;

	/**
	 * @var array
	 */
	private $_allowed_fields = null;

	public function __construct($allowedFields) {
		$this->_allowed_fields = $allowedFields;

		$this->_fields = array();
	}

	/**
	 * Sets keys for field
	 * 
	 * @param string		$name	name of the fields
	 * @param StandardKeys	$keys	keys to set
	 */
	public function setField($name, StandardKeys $keys) {
		if(!in_array($name, $this->_allowed_fields)) {
			throw new PHPassKitException($name . ' is not valid for ' . __CLASS__);
		}

		if(!array_key_exists($name, $this->_fields)) {
			$this->_fields[$name] = array();
		}

		$this->_fields[$name][] = $keys;
	}

	public function getFields($name) {
		if(isset($this->_fields[$name])) {
			return $this->_fields[$name];
		}

		return null;
	}

}