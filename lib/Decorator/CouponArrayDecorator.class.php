<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\StandardKeysArrayDecorator;
use PHPassKit\Style\Coupon;

class CouponArrayDecorator {
	/**
	 * @var StandardKeysArrayDecorator
	 */
	private $_keys_decorator = null;

	public function __construct(StandardKeysArrayDecorator $keysDecorator) {
		$this->_keys_decorator = $keysDecorator;
	}

	public function decorate(Coupon $coupon) {
		$output = array();

		$this->_addFields('header', $output, $coupon);
		$this->_addFields('primary', $output, $coupon);
		$this->_addFields('secondary', $output, $coupon);
		$this->_addFields('auxiliary', $output, $coupon);
		$this->_addFields('back', $output, $coupon);

		return $output;
	}

	private function _addFields($name, &$output, Coupon $coupon) {
		$fields = $coupon->getFields($name);
		if(!is_null($fields)) {
			$output[$name . 'Fields'] = $this->_keys_decorator->decorate($fields);
		}
	}
}