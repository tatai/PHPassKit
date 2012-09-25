<?php

use PHPassKit\Decorator\DateKeysArrayDecorator;
use PHPassKit\Decorator\FieldDictionaryArrayDecorator;
use PHPassKit\Keys\FieldDictionary\DateKeys;
use PHPassKit\Keys\FieldDictionary\DateStyle;

class DateKeysArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var DateKeysArrayDecorator
	 */
	private $_decorator = null;

	/**
	 * @var DateKeys
	 */
	private $_date_keys = null;

	public function setup() {
		$this->_date_keys = $this->getMock('PHPassKit\Keys\FieldDictionary\DateKeys', array(), array('a', 1));
		$this->_decorator = new DateKeysArrayDecorator();
	}

	/**
	 * @test
	 */
	public function classExtendsFromFieldDictionaryArrayDecorator() {
		$this->assertTrue($this->_decorator instanceof FieldDictionaryArrayDecorator);
	}

	/**
	 * @test
	 */
	public function dateStyleFromKeysIsUsed() {
		$this->_date_keys->expects($this->once())->method('getDateStyle');

		$this->_decorator->decorate($this->_date_keys);
	}

	/**
	 * @test
	 */
	public function whenDateStyleIsSetThenItIsInTheOutput() {
		$style = DateStyle::MEDIUM;
		$this->_date_keys->expects($this->any())->method('getDateStyle')->will($this->returnValue($style));

		$output = $this->_decorator->decorate($this->_date_keys);
		$this->assertEquals(DateStyle::getConstName($style), $output['dateStyle']);
	}

	/**
	 * @test
	 */
	public function whenDateStyleIsNotSetThenKeyIsNotInTheOutput() {
		$output = $this->_decorator->decorate($this->_date_keys);
		$this->assertFalse(array_key_exists('dateStyle', $output));
	}

	/**
	 * @test
	 */
	public function timeStyleFromKeysIsUsed() {
		$this->_date_keys->expects($this->once())->method('getTimeStyle');

		$this->_decorator->decorate($this->_date_keys);
	}

	/**
	 * @test
	 */
	public function whenTimeStyleIsSetThenItIsInTheOutput() {
		$style = DateStyle::MEDIUM;
		$this->_date_keys->expects($this->any())->method('getTimeStyle')->will($this->returnValue($style));

		$output = $this->_decorator->decorate($this->_date_keys);
		$this->assertEquals(DateStyle::getConstName($style), $output['timeStyle']);
	}

	/**
	 * @test
	 */
	public function whenTimeStyleIsNotSetThenKeyIsNotInTheOutput() {
		$output = $this->_decorator->decorate($this->_date_keys);
		$this->assertFalse(array_key_exists('timeStyle', $output));
	}

	/**
	 * @test
	 */
	public function isRelativeFlagIsUsed() {
		$this->_date_keys->expects($this->once())->method('getIsRelative');

		$this->_decorator->decorate($this->_date_keys);
	}

	/**
	 * @test
	 */
	public function isRelativeFlagIsInTheCorrectKeyInTheOutput() {
		$this->_date_keys->expects($this->any())->method('getIsRelative')->will($this->returnValue(true));

		$output = $this->_decorator->decorate($this->_date_keys);
		$this->assertTrue($output['isRelative']);
	}
}
