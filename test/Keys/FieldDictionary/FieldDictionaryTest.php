<?php

use PHPassKit\Keys\FieldDictionary\FieldDictionary;

class testFieldDictionary extends FieldDictionary {
	public function getValue() {
		
	}
}

class FieldDictionaryTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var testFieldDictionary
	 */
	private $_field = null;

	/**
	 * @var string
	 */
	private $_key = null;

	public function setup() {
		$this->_key = 'this is the key';
		$this->_field = new testFieldDictionary($this->_key);
	}

	/**
	 * @test
	 */
	public function keyCanBeRetrieved() {
		$this->assertEquals($this->_key, $this->_field->getKey());
	}

	/**
	 * @test
	 */
	public function changeMessageIsNullByDefault() {
		$this->assertNull($this->_field->getChangeMessage());
	}

	/**
	 * @test
	 */
	public function whenChangeMessageIsSetThenItCanBeRetrieved() {
		$message = 'message';
		$this->_field->setChangeMessage($message);

		$this->assertEquals($message, $this->_field->getChangeMessage());
	}

	/**
	 * @test
	 */
	public function labelIsNullByDefault() {
		$this->assertNull($this->_field->getLabel());
	}

	/**
	 * @test
	 */
	public function whenLabelIsSetThenItCanBeRetrieved() {
		$label = 'label';
		$this->_field->setLabel($label);

		$this->assertEquals($label, $this->_field->getLabel());
	}

	/**
	 * @test
	 */
	public function textAlignmentIsNullByDefault() {
		$this->assertNull($this->_field->getTextAlignment());
	}

	/**
	 * @test
	 */
	public function whenTextAlignmentIsSetThenItCanBeRetrieved() {
		$alignment = 6;
		$this->_field->setTextAlignment($alignment);

		$this->assertEquals($alignment, $this->_field->getTextAlignment());
	}

}