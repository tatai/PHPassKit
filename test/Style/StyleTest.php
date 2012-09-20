<?php
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
	public function whenSettingAllowedFieldsThenItCanBeRetrieved() {
		$keys = new StandardKeys('a', 'b');
		$this->_style->setFields('allowed', $keys);

		$this->assertEquals($keys, $this->_style->getFields('allowed'));
	}

	/**
	 * @test
	 */
	public function whenAnAllowedFieldsIsNotSetThenReturnsNull() {
		$this->assertNull($this->_style->getFields('allowed'));
	}

	/**
	 * @test
	 * @expectedException PHPassKitException
	 */
	public function whenTryingToSetFieldsThatAreNotAllowedThenThrowsException() {
		$this->_style->setFields('notAllowed', new StandardKeys('a', 'b'));
	}

}