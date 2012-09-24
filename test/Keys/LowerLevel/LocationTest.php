<?php

use PHPassKit\Keys\LowerLevel\Location;

class LocationTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Location
	 */
	private $_location = null;

	/**
	 * @var double
	 */
	private $_latitude = null;

	/**
	 * @var double
	 */
	private $_longitude = null;

	public function setup() {
		$this->_latitude = 0.3;
		$this->_longitude = -2.32;

		$this->_location = new Location($this->_latitude, $this->_longitude);
	}

	/**
	 * @test
	 */
	public function latitudeCanBeRetrieved() {
		$this->assertEquals($this->_latitude, $this->_location->getLatitude());
	}

	/**
	 * @test
	 */
	public function logitudeCanBeRetrieved() {
		$this->assertEquals($this->_longitude, $this->_location->getLongitude());
	}

	/**
	 * @test
	 */
	public function whenAltitudeIsSetThenItCanBeRetrieved() {
		$altitude = 4.3;
		$this->_location->setAltitude($altitude);

		$this->assertEquals($altitude, $this->_location->getAltitude());
	}

	/**
	 * @test
	 */
	public function whenRelevantTextIsSetThenItCanBeRetrieved() {
		$text = 'relevant text';
		$this->_location->setRelevantText($text);

		$this->assertEquals($text, $this->_location->getRelevantText());
	}

}
