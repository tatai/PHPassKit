<?php

use PHPassKit\Style\BoardingPass;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

class BoardingPassTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var BoardingPass
	 */
	private $_boarding_pass = null;

	/**
	 * @var FieldDictionary
	 */
	private $_keys = null;

	/**
	 * @var int
	 */
	private $_transit_type = null;

	public function setup() {
		$this->_keys = $this->getMock('\PHPassKit\Keys\FieldDictionary\FieldDictionary', array(), array('key'));
		$this->_transit_type = 2;
		$this->_boarding_pass = new BoardingPass($this->_transit_type);
	}

	/**
	 * @test
	 */
	public function acceptsHeaderFields() {
		$this->_boarding_pass->addKeys('header', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_boarding_pass->getKeys('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$this->_boarding_pass->addKeys('primary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_boarding_pass->getKeys('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$this->_boarding_pass->addKeys('secondary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_boarding_pass->getKeys('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$this->_boarding_pass->addKeys('auxiliary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_boarding_pass->getKeys('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$this->_boarding_pass->addKeys('back', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_boarding_pass->getKeys('back'));
	}

	/**
	 * @test
	 */
	public function transitTypeCanBeReturned() {
		$this->assertEquals($this->_transit_type, $this->_boarding_pass->getTransitType());
	}
}