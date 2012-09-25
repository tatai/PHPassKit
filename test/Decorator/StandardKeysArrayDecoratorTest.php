<?php

use PHPassKit\Decorator\StandardKeysArrayDecorator;
use PHPassKit\Decorator\FieldDictionaryArrayDecorator;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

class StandardKeysArrayDecoratorTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var StandardKeys
	 */
	private $_keys = null;

	/**
	 * @var StandardKeysArrayDecorator
	 */
	private $_decorator = null;

	public function setup() {
		$this->_keys = $this->getMock('PHPassKit\Keys\FieldDictionary\StandardKeys', array(), array('key', 'value'));
		$this->_decorator = new StandardKeysArrayDecorator();
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
	public function valueIsUsed() {
		$this->_keys->expects($this->once())->method('getValue');

		$this->_decorator->decorate($this->_keys);
	}

	/**
	 * @test
	 */
	public function valueIsInTheCorrectValue() {
		$value = 'value';
		$this->_keys->expects($this->any())->method('getValue')->will($this->returnValue($value));

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertEquals($value, $output['value']);
	}
}