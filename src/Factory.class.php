<?php

namespace PHPassKit;

use PHPassKit\Decorator\ArrayDecoratorManager;
use PHPassKit\Decorator\PHPassKitArrayDecorator;
use PHPassKit\Generator\Builder;
use PHPassKit\Generator\Manifest;
use PHPassKit\Util\Hasher;

class Factory {
	/**
	 * 
	 * @return Builder
	 */
	static public function builder() {
		return new Builder(
			new PHPassKitArrayDecorator(
				new ArrayDecoratorManager()
			),
			new Manifest(new Hasher())
		);
	}
}