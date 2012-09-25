<?php

namespace PHPassKit\Keys\LowerLevel;

class Location {

	/**
	 * @var double
	 */
	private $_latitude = null;

	/**
	 * @var double
	 */
	private $_longitude = null;

	/**
	 * @var double
	 */
	private $_altitude = null;

	/**
	 * @var string
	 */
	private $_relevant_text = null;

	/**
	 * 
	 * @param double 	$latitude
	 * @param double 	$longitude
	 */
	public function __construct($latitude, $longitude) {
		$this->_latitude = $latitude;
		$this->_longitude = $longitude;
	}

	/**
	 * @return double
	 */
	public function getLatitude() {
		return $this->_latitude;
	}

	/**
	 * @return double
	 */
	public function getLongitude() {
		return $this->_longitude;
	}

	/**
	 * @param double $altitude
	 */
	public function setAltitude($altitude) {
		$this->_altitude = $altitude;
	}

	/**
	 * @return double
	 */
	public function getAltitude() {
		return $this->_altitude;
	}

	/**
	 * @param string $relevantText
	 */
	public function setRelevantText($relevantText) {
		$this->_relevant_text = $relevantText;
	}

	/**
	 * @return string
	 */
	public function getRelevantText() {
		return $this->_relevant_text;
	}

}