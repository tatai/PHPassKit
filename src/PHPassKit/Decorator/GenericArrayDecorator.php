<?php

namespace PHPassKit\Decorator;

use PHPassKit\Decorator\ArrayDecoratorManager;
use PHPassKit\Style\Generic;

class GenericArrayDecorator {
	/**
	 * @var ArrayDecoratorManager
	 */
	private $_decorator_manager = null;

	public function __construct(ArrayDecoratorManager $decoratorManager) {
		$this->_decorator_manager = $decoratorManager;
	}

	public function decorate(Generic $boardingPass) {
		$output = array();

		$this->_addField('header', $output, $boardingPass);
		$this->_addField('primary', $output, $boardingPass);
		$this->_addField('secondary', $output, $boardingPass);
		$this->_addField('auxiliary', $output, $boardingPass);
		$this->_addField('back', $output, $boardingPass);

		return $output;
	}

	private function _addField($name, &$output, Generic $boardingPass) {
		$keys = $boardingPass->getKeys($name);
		if(!is_null($keys)) {
			foreach($keys as $key) {
				$output[$name . 'Fields'][] = $this->_decorator_manager->decorate($key);
			}
		}
	}
}