<?php

namespace PHPassKit\Style;

class Coupon extends Style {
	public function __construct() {
		parent::__construct(array('header', 'primary', 'secondary', 'auxiliary', 'back'));
	}
}