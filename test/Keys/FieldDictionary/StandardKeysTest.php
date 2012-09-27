<?php

use PHPassKit\Keys\FieldDictionary\StandardKeys;
use PHPassKit\Keys\FieldDictionary\FieldDictionary;

class StandardKeysTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var StandardKeys
	 */
	private $_field = null;

	/**
	 * @var string
	 */
	private $_value = null;

	public function setup() {
		$this->_value = 'this is the value';
		$this->_field = new StandardKeys('key', $this->_value);
	}

	/**
	 * @test
	 */
	public function classExtendsFromFieldDictionary() {
		$this->assertTrue($this->_field instanceof FieldDictionary);
	}

	/**
	 * @test
	 */
	public function valueCanBeRetrieved() {
		$this->assertEquals($this->_value, $this->_field->getValue());
	}

	/**
	 * @test
	 * @expectedException PHPassKit\Common\PHPassKitException
	 */
	public function whenValueIsNotAStringThenThrowsException() {
		new StandardKeys('key', 1);
	}

}