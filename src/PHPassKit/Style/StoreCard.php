<?php

namespace PHPassKit\Style;

class StoreCard extends Style {
	public function __construct() {
		parent::__construct(array('header', 'primary', 'secondary', 'auxiliary', 'back'));
	}
}