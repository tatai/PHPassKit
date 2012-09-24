<?php

use PHPassKit\Style\Coupon;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

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
		$this->_coupon->addKeys('header', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getKeys('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->addKeys('primary', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getKeys('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->addKeys('secondary', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getKeys('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->addKeys('auxiliary', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getKeys('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$keys = new StandardKeys('a', 'b');
		$this->_coupon->addKeys('back', $keys);

		$this->assertEquals(array($keys), $this->_coupon->getKeys('back'));
	}

}