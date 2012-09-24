<?php

use PHPassKit\Decorator\StandardKeysArrayDecorator;
use PHPassKit\Keys\FieldDictionary\TextAlignment;

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
	public function keyIsUsed() {
		$this->_keys->expects($this->once())->method('getKey');

		$this->_decorator->decorate($this->_keys);
	}

	/**
	 * @test
	 */
	public function keyIsInTheCorrectKey() {
		$key = 'key value';
		$this->_keys->expects($this->any())->method('getKey')->will($this->returnValue($key));

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertEquals($key, $output['key']);
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

	/**
	 * @test
	 */
	public function changeMessageIsUsed() {
		$this->_keys->expects($this->once())->method('getChangeMessage');

		$this->_decorator->decorate($this->_keys);
	}

	/**
	 * @test
	 */
	public function whenChangeMessageIsNotSetThenItIsNotPresentInTheOutput() {
		$this->_keys->expects($this->any())->method('getChangeMessage');

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertFalse(array_key_exists('changeMessage', $output));
	}

	/**
	 * @test
	 */
	public function whenChangeMessageIsSetThenItIsInTheCorrectKey() {
		$changeMessage = 'change message';
		$this->_keys->expects($this->any())->method('getChangeMessage')->will($this->returnValue($changeMessage));

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertEquals($changeMessage, $output['changeMessage']);
	}

	/**
	 * @test
	 */
	public function labelIsUsed() {
		$this->_keys->expects($this->once())->method('getLabel');

		$this->_decorator->decorate($this->_keys);
	}

	/**
	 * @test
	 */
	public function whenLabelIsNotSetThenItIsNotPresentInTheOutput() {
		$this->_keys->expects($this->any())->method('getLabel');

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertFalse(array_key_exists('label', $output));
	}

	/**
	 * @test
	 */
	public function whenLabelIsSetThenItIsInTheCorrectKey() {
		$label = 'change message';
		$this->_keys->expects($this->any())->method('getLabel')->will($this->returnValue($label));

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertEquals($label, $output['label']);
	}

	/**
	 * @test
	 */
	public function textAlignmentIsUsed() {
		$this->_keys->expects($this->once())->method('getTextAlignment');

		$this->_decorator->decorate($this->_keys);
	}

	/**
	 * @test
	 */
	public function whenTextAlignmentIsNotSetThenItIsNotPresentInTheOutput() {
		$this->_keys->expects($this->any())->method('getTextAlignment');

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertFalse(array_key_exists('textAlignment', $output));
	}

	/**
	 * @test
	 */
	public function whenTextAlignmentIsSetThenItIsInTheCorrectKeyWithTheValueTranslated() {
		$textAlignment = TextAlignment::CENTER;
		$this->_keys->expects($this->any())->method('getTextAlignment')->will($this->returnValue($textAlignment));

		$output = $this->_decorator->decorate($this->_keys);
		$this->assertEquals(TextAlignment::getConstName($textAlignment), $output['textAlignment']);
	}
}