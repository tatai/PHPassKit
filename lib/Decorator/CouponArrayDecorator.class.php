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

		$this->_addField('header', $output, $coupon);
		$this->_addField('primary', $output, $coupon);
		$this->_addField('secondary', $output, $coupon);
		$this->_addField('auxiliary', $output, $coupon);
		$this->_addField('back', $output, $coupon);

		return $output;
	}

	private function _addField($name, &$output, Coupon $coupon) {
		$keys = $coupon->getKeys($name);
		if(!is_null($keys)) {
			foreach($keys as $key) {
				$output[$name . 'Fields'][] = $this->_keys_decorator->decorate($key);
			}
		}
	}
}