<?php

use PHPassKit\Keys\FieldDictionary\Date;

class DateTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Date
	 */
	private $_date = null;

	public function setup() {
		$this->_date = new Date();
	}

	/**
	 * @test
	 */
	public function whenDateStyleIsNotSetThenNullIsReturned() {
		$this->assertNull($this->_date->getDateStyle());
	}

	/**
	 * @test
	 */
	public function whenDateStyleIsGivenThenItCanBeRetrieved() {
		$style = 3;
		$this->_date->setDateStyle($style);

		$this->assertEquals($style, $this->_date->getDateStyle());
	}

	/**
	 * @test
	 */
	public function whenTimeStyleIsNotSetThenNullIsReturned() {
		$this->assertNull($this->_date->getTimeStyle());
	}

	/**
	 * @test
	 */
	public function whenTimeStyleIsGivenThenItCanBeRetrieved() {
		$style = 1;
		$this->_date->setTimeStyle($style);

		$this->assertEquals($style, $this->_date->getTimeStyle());
	}

	/**
	 * @test
	 */
	public function defaultValueForIsRelativeIsFalse() {
		$this->assertFalse($this->_date->getIsRelative());
	}

	/**
	 * @test
	 */
	public function whenIsRelativeValueIsChangedThenItsNewValueCanBeReturned() {
		$this->_date->setIsRelative(true);

		$this->assertTrue($this->_date->getIsRelative());
	}
}