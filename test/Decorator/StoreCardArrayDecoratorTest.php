<?php

use PHPassKit\Decorator\StoreCardArrayDecorator;
use PHPassKit\Decorator\ArrayDecoratorManager;
use PHPassKit\Style\StoreCard;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

class StoreCardArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var StoreCard
	 */
	private $_store_card = null;

	/**
	 * @var StoreCardArrayDecorator
	 */
	private $_decorator = null;

	/**
	 * @var ArrayDecoratorManager
	 */
	private $_decorator_manager = null;

	public function setup() {
		$this->_store_card = $this->getMock('PHPassKit\Style\StoreCard', array(), array(2));
		$this->_decorator_manager = $this->getMock('PHPassKit\Decorator\ArrayDecoratorManager');
		$this->_decorator = new StoreCardArrayDecorator($this->_decorator_manager);
	}

	/**
	 * @test
	 */
	public function eachGroupOfFieldsIsUsed() {
		$this->_store_card->expects($this->exactly(5))->method('getKeys');

		$this->_decorator->decorate($this->_store_card);
	}	

	/**
	 * @test
	 */
	public function whenHeaderFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_store_card);

		$this->assertFalse(array_key_exists('headerFields', $output));
	}

	/**
	 * @test
	 */
	public function whenHeaderFieldsIsSetThenItIsDecorated() {
		$headerFields = array(new StandardKeys('key', 'value'));
		$this->_store_card->expects($this->any())->method('getKeys')->will($this->onConsecutiveCalls($headerFields));

		$expected = 'keys decoration';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->onConsecutiveCalls($expected));

		$output = $this->_decorator->decorate($this->_store_card);
		$this->assertEquals(array($expected), $output['headerFields']);
	}	

	/**
	 * @test
	 */
	public function whenPrimaryFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_store_card);

		$this->assertFalse(array_key_exists('primaryFields', $output));
	}

	/**
	 * @test
	 */
	public function whenPrimaryFieldsIsSetThenItIsDecorated() {
		$primaryFields = array(new StandardKeys('key', 'value'));
		$this->_store_card->expects($this->any())->method('getKeys')->will($this->onConsecutiveCalls(null, $primaryFields));

		$expected = 'keys decoration';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_store_card);
		$this->assertEquals(array($expected), $output['primaryFields']);
	}	

	/**
	 * @test
	 */
	public function whenSecondaryFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_store_card);

		$this->assertFalse(array_key_exists('secondaryFields', $output));
	}

	/**
	 * @test
	 */
	public function whenSecondaryFieldsIsSetThenItIsDecorated() {
		$secondaryFields = array(new StandardKeys('key', 'value'));
		$this->_store_card->expects($this->any())->method('getKeys')->will($this->onConsecutiveCalls(null, null, $secondaryFields));

		$expected = 'keys decoration';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_store_card);
		$this->assertEquals(array($expected), $output['secondaryFields']);
	}	

	/**
	 * @test
	 */
	public function whenAuxiliaryFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_store_card);

		$this->assertFalse(array_key_exists('auxiliaryFields', $output));
	}

	/**
	 * @test
	 */
	public function whenAuxiliaryFieldsIsSetThenItIsDecorated() {
		$auxiliaryFields = array(new StandardKeys('key', 'value'));
		$this->_store_card->expects($this->any())->method('getKeys')->will($this->onConsecutiveCalls(null, null, null, $auxiliaryFields));

		$expected = 'keys decoration';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_store_card);
		$this->assertEquals(array($expected), $output['auxiliaryFields']);
	}	

	/**
	 * @test
	 */
	public function whenBackFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_store_card);

		$this->assertFalse(array_key_exists('backFields', $output));
	}

	/**
	 * @test
	 */
	public function whenBackFieldsIsSetThenItIsDecorated() {
		$backFields = array(new StandardKeys('key', 'value'));
		$this->_store_card->expects($this->any())->method('getKeys')->will($this->onConsecutiveCalls(null, null, null, null, $backFields));

		$expected = 'keys decoration';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_store_card);
		$this->assertEquals(array($expected), $output['backFields']);
	}

}