<?php

use PHPassKit\Decorator\CouponArrayDecorator;
use PHPassKit\Decorator\StandardKeysArrayDecorator;
use PHPassKit\Style\Coupon;
use PHPassKit\FieldDictionaryKeys\StandardKeys;

class CouponArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Coupon
	 */
	private $_coupon = null;

	/**
	 * @var CouponArrayDecorator
	 */
	private $_decorator = null;

	/**
	 * @var StandardKeysArrayDecorator
	 */
	private $_keys_decorator = null;

	public function setup() {
		$this->_coupon = $this->getMock('PHPassKit\Style\Coupon');
		$this->_keys_decorator = $this->getMock('PHPassKit\Decorator\StandardKeysArrayDecorator');
		$this->_decorator = new CouponArrayDecorator($this->_keys_decorator);
	}

	/**
	 * @tes
	 */
	public function eachGroupOfFieldsIsUsed() {
		$this->_coupon->expects($this->exactly(2))->method('getFields');

		$this->_decorator->decorate($this->_coupon);
	}	

	/**
	 * @test
	 */
	public function whenHeaderFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_coupon);

		$this->assertFalse(array_key_exists('headerFields', $output));
	}

	/**
	 * @test
	 */
	public function whenHeaderFieldsIsSetThenItIsDecorated() {
		$headerFields = new StandardKeys('key', 'value');
		$this->_coupon->expects($this->any())->method('getFields')->will($this->onConsecutiveCalls($headerFields));

		$expected = 'keys decoration';
		$this->_keys_decorator->expects($this->any())->method('decorate')->will($this->onConsecutiveCalls($expected));

		$output = $this->_decorator->decorate($this->_coupon);
		$this->assertEquals($expected, $output['headerFields']);
	}	

	/**
	 * @test
	 */
	public function whenPrimaryFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_coupon);

		$this->assertFalse(array_key_exists('primaryFields', $output));
	}

	/**
	 * @test
	 */
	public function whenPrimaryFieldsIsSetThenItIsDecorated() {
		$primaryFields = new StandardKeys('key', 'value');
		$this->_coupon->expects($this->any())->method('getFields')->will($this->onConsecutiveCalls(null, $primaryFields));

		$expected = 'keys decoration';
		$this->_keys_decorator->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_coupon);
		$this->assertEquals($expected, $output['primaryFields']);
	}	

	/**
	 * @test
	 */
	public function whenSecondaryFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_coupon);

		$this->assertFalse(array_key_exists('secondaryFields', $output));
	}

	/**
	 * @test
	 */
	public function whenSecondaryFieldsIsSetThenItIsDecorated() {
		$secondaryFields = new StandardKeys('key', 'value');
		$this->_coupon->expects($this->any())->method('getFields')->will($this->onConsecutiveCalls(null, null, $secondaryFields));

		$expected = 'keys decoration';
		$this->_keys_decorator->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_coupon);
		$this->assertEquals($expected, $output['secondaryFields']);
	}	

	/**
	 * @test
	 */
	public function whenAuxiliaryFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_coupon);

		$this->assertFalse(array_key_exists('auxiliaryFields', $output));
	}

	/**
	 * @test
	 */
	public function whenAuxiliaryFieldsIsSetThenItIsDecorated() {
		$auxiliaryFields = new StandardKeys('key', 'value');
		$this->_coupon->expects($this->any())->method('getFields')->will($this->onConsecutiveCalls(null, null, null, $auxiliaryFields));

		$expected = 'keys decoration';
		$this->_keys_decorator->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_coupon);
		$this->assertEquals($expected, $output['auxiliaryFields']);
	}	

	/**
	 * @test
	 */
	public function whenBackFieldsIsNotSetThenItIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_coupon);

		$this->assertFalse(array_key_exists('backFields', $output));
	}

	/**
	 * @test
	 */
	public function whenBackFieldsIsSetThenItIsDecorated() {
		$backFields = new StandardKeys('key', 'value');
		$this->_coupon->expects($this->any())->method('getFields')->will($this->onConsecutiveCalls(null, null, null, null, $backFields));

		$expected = 'keys decoration';
		$this->_keys_decorator->expects($this->any())->method('decorate')->will($this->returnValue($expected));

		$output = $this->_decorator->decorate($this->_coupon);
		$this->assertEquals($expected, $output['backFields']);
	}	
}