<?php

use PHPassKit\Keys\FieldDictionary\NumberKeys;
use PHPassKit\Keys\FieldDictionary\FieldDictionary;

class NumberKeysTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var NumberKeys
	 */
	private $_number = null;

	public function setup() {
		$this->_number = new NumberKeys('key', 3.4);
	}

	/**
	 * @test
	 */
	public function classExtendsFromFieldDictionary() {
		$this->assertTrue($this->_number instanceof FieldDictionary);
	}

	/**
	 * @test
	 * @expectedException PHPassKit\Common\PHPassKitException
	 */
	public function whenValueIsNotANumberThenThrowsException() {
		new NumberKeys('a', 'b');
	}

	/**
	 * @test
	 * @expectedException PHPassKit\Common\PHPassKitException
	 */
	public function whenValueIsANumberInStringFormatThenThrowsException() {
		new NumberKeys('a', '3.2');
	}

	/**
	 * @test
	 */
	public function numberCanBeReturnedAsValue() {
		$this->assertEquals(3.4, $this->_number->getValue());
	}

	/**
	 * @test
	 */
	public function whenCurrencyCodeIsGivenThenItCanBeReturned() {
		$code = 'EUR';
		$this->_number->setCurrencyCode($code);

		$this->assertEquals($code, $this->_number->getCurrencyCode());
	}

	/**
	 * @test
	 */
	public function whenLabelIsSetThenItCanBeRetrieved() {
		$label = 'label';
		$keys = new NumberKeys('key', 2, $label);

		$this->assertEquals($label, $keys->getLabel());
	}
}