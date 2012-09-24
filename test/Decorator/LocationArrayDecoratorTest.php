<?php

use PHPassKit\Keys\LowerLevel\Location;
use PHPassKit\Decorator\LocationArrayDecorator;

class LocationArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Location
	 */
	private $_location = null;

	/**
	 * @var LocationArrayDecorator
	 */
	private $_decorator = null;

	public function setup() {
		$this->_location = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(0, 0));
		$this->_decorator = new LocationArrayDecorator();
	}

	/**
	 * @test
	 */
	public function latitudeIsUsed() {
		$this->_location->expects($this->once())->method('getLatitude');

		$this->_decorator->decorate($this->_location);
	}

	/**
	 * @test
	 */
	public function latitudeIsInTheCorrectKey() {
		$latitude = 4.3;
		$this->_location->expects($this->any())->method('getLatitude')->will($this->returnValue($latitude));

		$output = $this->_decorator->decorate($this->_location);
		$this->assertEquals($latitude, $output['latitude']);
	}

	/**
	 * @test
	 */
	public function longitudeIsUsed() {
		$this->_location->expects($this->once())->method('getLongitude');

		$this->_decorator->decorate($this->_location);
	}

	/**
	 * @test
	 */
	public function longitudeIsInTheCorrectKey() {
		$longitude = 4.3;
		$this->_location->expects($this->any())->method('getLongitude')->will($this->returnValue($longitude));

		$output = $this->_decorator->decorate($this->_location);
		$this->assertEquals($longitude, $output['longitude']);
	}

	/**
	 * @test
	 */
	public function altitudeTextIsUsed() {
		$this->_location->expects($this->once())->method('getAltitude');

		$this->_decorator->decorate($this->_location);
	}

	/**
	 * @test
	 */
	public function whenAltitudeIsNotSetThenItsKeyIsNotSet() {
		$this->_location->expects($this->any())->method('getAltitude');

		$output = $this->_decorator->decorate($this->_location);
		$this->assertFalse(array_key_exists('altitude', $output));
	}

	/**
	 * @test
	 */
	public function whenAltitudeIsSetThenItIsInTheCorrectKey() {
		$altitude = 34.2;
		$this->_location->expects($this->any())->method('getAltitude')->will($this->returnValue($altitude));

		$output = $this->_decorator->decorate($this->_location);
		$this->assertEquals($altitude, $output['altitude']);
	}

	/**
	 * @test
	 */
	public function relevantTextTextIsUsed() {
		$this->_location->expects($this->once())->method('getRelevantText');

		$this->_decorator->decorate($this->_location);
	}

	/**
	 * @test
	 */
	public function whenRelevantTextIsNotSetThenItsKeyIsNotSet() {
		$this->_location->expects($this->any())->method('getRelevantText');

		$output = $this->_decorator->decorate($this->_location);
		$this->assertFalse(array_key_exists('relevantText', $output));
	}

	/**
	 * @test
	 */
	public function whenRelevantTextIsSetThenItIsInTheCorrectKey() {
		$text = 'relevant text';
		$this->_location->expects($this->any())->method('getRelevantText')->will($this->returnValue($text));

		$output = $this->_decorator->decorate($this->_location);
		$this->assertEquals($text, $output['relevantText']);
	}

}