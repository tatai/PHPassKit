<?php

use PHPassKit\Style\Coupon;
use PHPassKit\FieldDictionaryKeys\StandardKeys;

class CouponTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Coupon
	 */
	private $_coupon = null;

	public function setup() {
		$this->_coupon = new Coupon();
	}

	/**
	 * @test
	 */
	public function acceptsHeaderFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setField('header', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getFields('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setField('primary', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getFields('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setField('secondary', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getFields('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setField('auxiliary', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getFields('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setField('back', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getFields('back'));
	}

}