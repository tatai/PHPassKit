<?php

use PHPassKit\Style\Generic;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

class GenericTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Generic
	 */
	private $_generic = null;

	/**
	 * @var FieldDictionary
	 */
	private $_keys = null;

	public function setup() {
		$this->_keys = $this->getMock('\PHPassKit\Keys\FieldDictionary\FieldDictionary', array(), array('key'));
		$this->_generic = new Generic();
	}

	/**
	 * @test
	 */
	public function acceptsHeaderFields() {
		$this->_generic->addKeys('header', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_generic->getKeys('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$this->_generic->addKeys('primary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_generic->getKeys('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$this->_generic->addKeys('secondary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_generic->getKeys('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$this->_generic->addKeys('auxiliary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_generic->getKeys('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$this->_generic->addKeys('back', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_generic->getKeys('back'));
	}
}