<?php

namespace PHPassKit;

use PHPassKit\Decorator\CouponArrayDecorator;
use PHPassKit\Decorator\PHPassKitArrayDecorator;
use PHPassKit\Decorator\StandardKeysArrayDecorator;
use PHPassKit\Decorator\BarcodeArrayDecorator;
use PHPassKit\Generator\Builder;
use PHPassKit\Generator\Manifest;
use PHPassKit\Util\Hasher;

class Factory {
	/**
	 * 
	 * @return Builder
	 */
	static public function builder() {
		return new Builder(new PHPassKitArrayDecorator(new CouponArrayDecorator(new StandardKeysArrayDecorator()), new BarcodeArrayDecorator()), new Manifest(new Hasher()));
	}
}