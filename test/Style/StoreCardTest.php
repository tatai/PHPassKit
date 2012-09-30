<?php

use PHPassKit\Style\StoreCard;
use PHPassKit\Keys\FieldDictionary\StandardKeys;

class StoreCardTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var StoreCard
	 */
	private $_store_card = null;

	/**
	 * @var FieldDictionary
	 */
	private $_keys = null;

	public function setup() {
		$this->_keys = $this->getMock('\PHPassKit\Keys\FieldDictionary\FieldDictionary', array(), array('key'));
		$this->_store_card = new StoreCard();
	}

	/**
	 * @test
	 */
	public function acceptsHeaderFields() {
		$this->_store_card->addKeys('header', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_store_card->getKeys('header'));
	}

	/**
	 * @test
	 */
	public function acceptsPrimaryFields() {
		$this->_store_card->addKeys('primary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_store_card->getKeys('primary'));
	}

	/**
	 * @test
	 */
	public function acceptsSecondaryFields() {
		$this->_store_card->addKeys('secondary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_store_card->getKeys('secondary'));
	}

	/**
	 * @test
	 */
	public function acceptsAuxiliaryFields() {
		$this->_store_card->addKeys('auxiliary', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_store_card->getKeys('auxiliary'));
	}

	/**
	 * @test
	 */
	public function acceptsBackFields() {
		$this->_store_card->addKeys('back', $this->_keys);

		$this->assertEquals(array($this->_keys), $this->_store_card->getKeys('back'));
	}
}