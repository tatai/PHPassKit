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
		$this->_coupon->setFields('header', $keys);

		$this->assertEquals($keys, $this->_coupon->getFields('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setFields('primary', $keys);

		$this->assertEquals($keys, $this->_coupon->getFields('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setFields('secondary', $keys);

		$this->assertEquals($keys, $this->_coupon->getFields('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setFields('auxiliary', $keys);

		$this->assertEquals($keys, $this->_coupon->getFields('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->setFields('back', $keys);

		$this->assertEquals($keys, $this->_coupon->getFields('back'));
	}

}