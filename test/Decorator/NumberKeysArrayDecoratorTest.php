<?php

use PHPassKit\Decorator\NumberKeysArrayDecorator;
use PHPassKit\Decorator\FieldDictionaryArrayDecorator;
use PHPassKit\Keys\FieldDictionary\NumberKeys;
use PHPassKit\Keys\FieldDictionary\NumberStyle;

class NumberKeysArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var NumberKeysArrayDecorator
	 */
	private $_decorator = null;

	/**
	 * @var NumberKeys
	 */
	private $_number_keys = null;

	public function setup() {
		$this->_number_keys = $this->getMock('PHPassKit\Keys\FieldDictionary\NumberKeys', array(), array('a', 7.2));
		$this->_decorator = new NumberKeysArrayDecorator();
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
	public function numberStyleFromKeysIsUsed() {
		$this->_number_keys->expects($this->once())->method('getNumberStyle');

		$this->_decorator->decorate($this->_number_keys);
	}

	/**
	 * @test
	 */
	public function whenNumberStyleIsSetThenItIsInTheOutput() {
		$style = NumberStyle::SCIENTIFIC;
		$this->_number_keys->expects($this->any())->method('getNumberStyle')->will($this->returnValue($style));

		$output = $this->_decorator->decorate($this->_number_keys);
		$this->assertEquals(NumberStyle::getConstName($style), $output['numberStyle']);
	}

	/**
	 * @test
	 */
	public function whenNumberStyleIsNotSetThenKeyIsNotInTheOutput() {
		$output = $this->_decorator->decorate($this->_number_keys);
		$this->assertFalse(array_key_exists('numberStyle', $output));
	}

	/**
	 * @test
	 */
	public function currencyCodeIsUsed() {
		$this->_number_keys->expects($this->once())->method('getCurrencyCode');

		$this->_decorator->decorate($this->_number_keys);
	}

	/**
	 * @test
	 */
	public function currencyCodeIsInTheCorrectKeyInTheOutput() {
		$code = 'EUR';
		$this->_number_keys->expects($this->any())->method('getCurrencyCode')->will($this->returnValue($code));

		$output = $this->_decorator->decorate($this->_number_keys);
		$this->assertEquals($code, $output['currencyCode']);
	}

	/**
	 * @test
	 */
	public function whenCurrencyCodeIsNotSetThenOutputDoesNotHaveItsKey() {
		$output = $this->_decorator->decorate($this->_number_keys);
		$this->assertFalse(array_key_exists('currencyCode', $output));
	}

	/**
	 * @test
	 */
	public function valueFromKeysIsUsed() {
		$this->_number_keys->expects($this->once())->method('getValue');

		$this->_decorator->decorate($this->_number_keys);
	}

	/**
	 * @test
	 */
	public function valueIsInTheCorrectKey() {
		$value = -12.2;
		$this->_number_keys->expects($this->any())->method('getValue')->will($this->returnValue($value));

		$output = $this->_decorator->decorate($this->_number_keys);
		$this->assertEquals($value, $output['value']);
	}
}
