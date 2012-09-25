<?php

namespace PHPassKit\Style;

use PHPassKit\Keys\FieldDictionary\FieldDictionary;
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
	 * Add keys for field
	 * 
	 * @param string			$fieldName	name of the fields
	 * @param FieldDictionary	$keys		keys to set
	 */
	public function addKeys($fieldName, FieldDictionary $keys) {
		if(!in_array($fieldName, $this->_allowed_fields)) {
			throw new PHPassKitException($fieldName . ' is not a valid field name for ' . __CLASS__);
		}

		if(!array_key_exists($fieldName, $this->_fields)) {
			$this->_fields[$fieldName] = array();
		}

		$this->_fields[$fieldName][] = $keys;
	}

	/**
	 * Returns all keys for field
	 * 
	 * @param string	$fieldName	name of the fields
	 * 
	 * @return StandardKeys
	 */
	public function getKeys($fieldName) {
		if(isset($this->_fields[$fieldName])) {
			return $this->_fields[$fieldName];
		}

		return null;
	}

}