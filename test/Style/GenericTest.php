<?php

use PHPassKit\Style\Generic;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

class GenericTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Generic
	 */
	private $_event_ticket = null;

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
		$this->_event_ticket = new Generic($this->_transit_type);
	}

	/**
	 * @test
	 */
	public function acceptsHeaderFields() {
		$this->_event_ticket->addKeys('header', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_event_ticket->getKeys('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$this->_event_ticket->addKeys('primary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_event_ticket->getKeys('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$this->_event_ticket->addKeys('secondary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_event_ticket->getKeys('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$this->_event_ticket->addKeys('auxiliary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_event_ticket->getKeys('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$this->_event_ticket->addKeys('back', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_event_ticket->getKeys('back'));
	}
}