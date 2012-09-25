<?php

use PHPassKit\Keys\FieldDictionary\DateKeys;
use PHPassKit\Keys\FieldDictionary\FieldDictionary;

class DateKeysTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Date
	 */
	private $_date = null;

	public function setup() {
		$this->_date = new DateKeys('key', 1);
	}

	/**
	 * @test
	 */
	public function classExtendsFromFieldDictionary() {
		$this->assertTrue($this->_date instanceof FieldDictionary);
	}

	/**
	 * @test
	 * @expectedException PHPassKit\PHPassKitException
	 */
	public function whenValueIsNotATimestampThenThrowsException() {
		new DateKeys('a', 'b');
	}

	/**
	 * @test
	 */
	public function timestampCanBeReturnedAsValue() {
		$this->assertEquals(1, $this->_date->getValue());
	}

	/**
	 * @test
	 */
	public function whenTimestampIsAnIntegerGivenAsStringThenItIsConvertedToInteger() {
		$date = new DateKeys('key', '34');

		$this->assertTrue(34 === $date->getValue());
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