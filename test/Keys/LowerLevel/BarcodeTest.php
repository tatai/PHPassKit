<?php

use PHPassKit\Keys\LowerLevel\Barcode;

class BarcodeTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Barcode
	 */
	private $_barcode = null;

	/**
	 * @var string
	 */
	private $_format = null;

	/**
	 * @var string
	 */
	private $_message = null;

	/**
	 * @var string
	 */
	private $_encoding = null;

	public function setup() {
		$this->_format = 2;
		$this->_message = 'this is the message';
		$this->_encoding = 'encoding';

		$this->_barcode = new Barcode($this->_format, $this->_message, $this->_encoding);
	}

	/**
	 * @test
	 */
	public function formatCanBeRetrieved() {
		$this->assertEquals($this->_format, $this->_barcode->getFormat());
	}

	/**
	 * @test
	 */
	public function messageCanBeRetrieved() {
		$this->assertEquals($this->_message, $this->_barcode->getMessage());
	}

	/**
	 * @test
	 */
	public function encodingCanBeRetrieved() {
		$this->assertEquals($this->_encoding, $this->_barcode->getEncoding());
	}

	/**
	 * @test
	 */
	public function whenAlternateTextIsSetThenItCanBeRetrieved() {
		$text = 'alternate text';
		$this->_barcode->setAlternateText($text);

		$this->assertEquals($text, $this->_barcode->getAlternateText());
	}
}