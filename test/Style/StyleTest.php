<?php

use PHPassKit\Style\Style;
use PHPassKit\FieldDictionaryKeys\StandardKeys;

class testStyle extends Style {
	public function __construct() {
		parent::__construct(array('allowed'));
	}
}

class StyleTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var testStyle
	 */
	private $_style = null;

	public function setup() {
		$this->_style = new testStyle();
	}

	/**
	 * @test
	 */
	public function whenSettingOneAllowedFieldThenItCanBeRetrieved() {
		$keys = new StandardKeys('a', 'b');
		$this->_style->addKeys('allowed', $keys);

		$this->assertEquals(array($keys), $this->_style->getKeys('allowed'));
	}

	/**
	 * @test
	 */
	public function whenSettingMoreThanOneAllowedFieldsThenItCanBeRetrieved() {
		$keys1 = new StandardKeys('a', 'b');
		$keys2 = new StandardKeys('a', 'b');
		$this->_style->addKeys('allowed', $keys1);
		$this->_style->addKeys('allowed', $keys2);

		$this->assertEquals(array($keys1, $keys2), $this->_style->getKeys('allowed'));
	}

	/**
	 * @test
	 */
	public function whenAnAllowedFieldsIsNotSetThenReturnsNull() {
		$this->assertNull($this->_style->getKeys('allowed'));
	}

	/**
	 * @test
	 * @expectedException PHPassKit\PHPassKitException
	 */
	public function whenTryingToSetFieldsThatAreNotAllowedThenThrowsException() {
		$this->_style->addKeys('notAllowed', new StandardKeys('a', 'b'));
	}

}