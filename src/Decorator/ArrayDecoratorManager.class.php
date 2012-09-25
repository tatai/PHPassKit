<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\ArrayDecoratorFactory;
use PHPassKit\PHPassKitException;

class ArrayDecoratorManager {

	/**
	 * @var array of decorators
	 */
	private $_cache = null;

	public function __construct() {
		$this->_cache = array();
	}

	public function decorate($object) {
		$decorator = $this->getDecoratorFor(get_class($object));
		return $decorator->decorate($object);
	}

	public function getDecoratorFor($className) {
		$parts = explode('\\', $className);
		$name = array_pop($parts);

		if(isset($this->_cache[$name])) {
			return $this->_cache[$name];
		}

		$decoratorName = __NAMESPACE__ . '\\' . $name . 'ArrayDecorator';

		if(class_exists($decoratorName)) {
			return new $decoratorName($this);
		}

		throw new PHPassKitException('Cannot find decorator for ' . $className . ' - ' . $decoratorName);
	}

}