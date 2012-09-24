<?php

use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\Keys\LowerLevel\BarcodeFormat;
use PHPassKit\Decorator\BarcodeArrayDecorator;

class BarcodeArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Barcode
	 */
	private $_barcode = null;

	/**
	 * @var BarcodeArrayDecorator
	 */
	private $_decorator = null;

	public function setup() {
		$this->_barcode = $this->getMock('PHPassKit\Keys\LowerLevel\Barcode', array(), array(1, 'message', 'encoding'));
		$this->_decorator = new BarcodeArrayDecorator();
	}

	/**
	 * @test
	 */
	public function formatIsUsed() {
		$this->_barcode->expects($this->once())->method('getFormat');

		$this->_decorator->decorate($this->_barcode);
	}

	/**
	 * @test
	 */
	public function formatIsInTheCorrectKey() {
		$format = BarcodeFormat::QR;
		$this->_barcode->expects($this->any())->method('getFormat')->will($this->returnValue($format));

		$output = $this->_decorator->decorate($this->_barcode);
		$this->assertEquals(BarcodeFormat::getConstName($format), $output['format']);
	}

	/**
	 * @test
	 */
	public function messageIsUsed() {
		$this->_barcode->expects($this->once())->method('getMessage');

		$this->_decorator->decorate($this->_barcode);
	}

	/**
	 * @test
	 */
	public function messageIsInTheCorrectKey() {
		$message = 'message';
		$this->_barcode->expects($this->any())->method('getMessage')->will($this->returnValue($message));

		$output = $this->_decorator->decorate($this->_barcode);
		$this->assertEquals($message, $output['message']);
	}

	/**
	 * @test
	 */
	public function encodingIsUsed() {
		$this->_barcode->expects($this->once())->method('getEncoding');

		$this->_decorator->decorate($this->_barcode);
	}

	/**
	 * @test
	 */
	public function encodingIsInTheCorrectKey() {
		$encoding = 'encoding';
		$this->_barcode->expects($this->any())->method('getEncoding')->will($this->returnValue($encoding));

		$output = $this->_decorator->decorate($this->_barcode);
		$this->assertEquals($encoding, $output['messageEncoding']);
	}

	/**
	 * @test
	 */
	public function alternateTextIsUsed() {
		$this->_barcode->expects($this->once())->method('getAlternateText');

		$this->_decorator->decorate($this->_barcode);
	}

	/**
	 * @test
	 */
	public function whenAlternateTextIsNotSetThenItsKeyIsNotSet() {
		$this->_barcode->expects($this->any())->method('getAlternateText');

		$output = $this->_decorator->decorate($this->_barcode);
		$this->assertFalse(array_key_exists('altText', $output));
	}

	/**
	 * @test
	 */
	public function whenAlternateTextIsSetThenItIsInTheCorrectKey() {
		$altText = 'alternate text';
		$this->_barcode->expects($this->any())->method('getAlternateText')->will($this->returnValue($altText));

		$output = $this->_decorator->decorate($this->_barcode);
		$this->assertEquals($altText, $output['altText']);
	}

}