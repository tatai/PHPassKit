<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\ArrayDecoratorManager;
use PHPassKit\Style\Coupon;

class CouponArrayDecorator {
	/**
	 * @var ArrayDecoratorManager
	 */
	private $_decorator_manager = null;

	public function __construct(ArrayDecoratorManager $decoratorManager) {
		$this->_decorator_manager = $decoratorManager;
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
				$output[$name . 'Fields'][] = $this->_decorator_manager->decorate($key);
			}
		}
	}
}