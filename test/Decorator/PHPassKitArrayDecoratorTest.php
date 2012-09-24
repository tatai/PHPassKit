<?php

use PHPassKit\PHPassKit;
use PHPassKit\Decorator\PHPassKitArrayDecorator;
use PHPassKit\Decorator\CouponArrayDecorator;
use PHPassKit\Decorator\StandardKeysArrayDecorator;
use PHPassKit\Decorator\BarcodeArrayDecorator;
use PHPassKit\Style\Coupon;

class PHPassKitArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var PHPassKit
	 */
	private $_pass_kit = null;

	/**
	 * @var PHPassKitArrayDecorator
	 */
	private $_decorator = null;

	/**
	 * @var CouponArrayDecorator
	 */
	private $_coupon_decorator = null;

	/**
	 * @var BarcodeArrayDecorator
	 */
	private $_barcode_decorator = null;

	public function setup() {
		$this->_pass_kit = $this->getMock('PHPassKit\PHPassKit', array(), array('a', 'a', 'a', 'a', 'a'));
		$this->_coupon_decorator = $this->getMock('PHPassKit\Decorator\CouponArrayDecorator', array(), array(new StandardKeysArrayDecorator()));
		$this->_barcode_decorator = $this->getMock('PHPassKit\Decorator\BarcodeArrayDecorator', array(), array());
		$this->_decorator = new PHPassKitArrayDecorator($this->_coupon_decorator, $this->_barcode_decorator);
	}

	/**
	 * @test
	 */
	public function descriptionIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getDescription');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function descriptionIsInTheCorrectKey() {
		$description = 'PassKit description';
		$this->_pass_kit->expects($this->any())->method('getDescription')->will($this->returnValue($description));

		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($description, $output['description']);
	}

	/**
	 * @test
	 */
	public function formatVersionIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getFormatVersion');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function formatVersionIsInTheCorrectKey() {
		$formatVersion = 'PassKit format version';
		$this->_pass_kit->expects($this->any())->method('getFormatVersion')->will($this->returnValue($formatVersion));

		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($formatVersion, $output['formatVersion']);
	}

	/**
	 * @test
	 */
	public function organizationNameIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getOrganizationName');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function organizationNameIsInTheCorrectKey() {
		$organizationName = 'PassKit organization name';
		$this->_pass_kit->expects($this->any())->method('getOrganizationName')->will($this->returnValue($organizationName));

		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($organizationName, $output['organizationName']);
	}

	/**
	 * @test
	 */
	public function passTypeIdentifierIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getPassTypeIdentifier');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function passTypeIdentifierIsInTheCorrectKey() {
		$passTypeIdentifier = 'PassKit pass type identifier';
		$this->_pass_kit->expects($this->any())->method('getPassTypeIdentifier')->will($this->returnValue($passTypeIdentifier));

		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($passTypeIdentifier, $output['passTypeIdentifier']);
	}

	/**
	 * @test
	 */
	public function serialNumberIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getSerialNumber');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function serialNumberIsInTheCorrectKey() {
		$serialNumber = 'PassKit pass type identifier';
		$this->_pass_kit->expects($this->any())->method('getSerialNumber')->will($this->returnValue($serialNumber));

		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($serialNumber, $output['serialNumber']);
	}

	/**
	 * @test
	 */
	public function teamIdentifierIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getTeamIdentifier');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function teamIdentifierIsInTheCorrectKey() {
		$teamIdentifier = 'PassKit pass type identifier';
		$this->_pass_kit->expects($this->any())->method('getTeamIdentifier')->will($this->returnValue($teamIdentifier));

		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($teamIdentifier, $output['teamIdentifier']);
	}

	/**
	 * @test
	 */
	public function styleIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getStyle');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenStyleIsCouponThenItIsDecoratedInTheCorrectKey() {
		$coupon = $this->getMock('PHPassKit\Style\Coupon');
		$this->_pass_kit->expects($this->any())->method('getStyle')->will($this->returnValue($coupon));

		$expected = 'decoration result';
		$this->_coupon_decorator->expects($this->once())->method('decorate')->will($this->returnValue($expected));
		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($expected, $output['coupon']);
	}

	/**
	 * @test
	 */
	public function backgroundColorIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getBackgroundColor');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenBackgroundColorIsNotAnArrayThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getBackgroundColor')->will($this->returnValue('a'));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('backgroundColor', $output));
	}

	/**
	 * @test
	 */
	public function whenBackgroundColorIsNotAnArrayWithThreeValuesThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getBackgroundColor')->will($this->returnValue(array(12, 32)));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('backgroundColor', $output));
	}

	/**
	 * @test
	 */
	public function whenBackgroundColorIsSetThenItIsAtTheCorrectKeyInTheOutput() {
		$color = array(23, 54, 127);
		$this->_pass_kit->expects($this->any())->method('getBackgroundColor')->will($this->returnValue($color));

		$expected = sprintf('rgb(%d, %d, %d)', $color[0], $color[1], $color[2]);

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($expected, $output['backgroundColor']);
	}


	/**
	 * @test
	 */
	public function foregroundColorIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getForegroundColor');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenForegroundColorIsNotAnArrayThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getForegroundColor')->will($this->returnValue('a'));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('foregroundColor', $output));
	}

	/**
	 * @test
	 */
	public function whenForegroundColorIsNotAnArrayWithThreeValuesThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getForegroundColor')->will($this->returnValue(array(12, 32)));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('foregroundColor', $output));
	}

	/**
	 * @test
	 */
	public function whenForegroundColorIsSetThenItIsAtTheCorrectKeyInTheOutput() {
		$color = array(23, 54, 127);
		$this->_pass_kit->expects($this->any())->method('getForegroundColor')->will($this->returnValue($color));

		$expected = sprintf('rgb(%d, %d, %d)', $color[0], $color[1], $color[2]);

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($expected, $output['foregroundColor']);
	}


	/**
	 * @test
	 */
	public function labelColorIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getLabelColor');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenLabelColorIsNotAnArrayThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getLabelColor')->will($this->returnValue('a'));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('labelColor', $output));
	}

	/**
	 * @test
	 */
	public function whenLabelColorIsNotAnArrayWithThreeValuesThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getLabelColor')->will($this->returnValue(array(12, 32)));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('labelColor', $output));
	}

	/**
	 * @test
	 */
	public function whenLabelColorIsSetThenItIsAtTheCorrectKeyInTheOutput() {
		$color = array(23, 54, 127);
		$this->_pass_kit->expects($this->any())->method('getLabelColor')->will($this->returnValue($color));

		$expected = sprintf('rgb(%d, %d, %d)', $color[0], $color[1], $color[2]);

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($expected, $output['labelColor']);
	}

	/**
	 * @test
	 */
	public function logoTextIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getLogoText');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenLogoTextIsNotSetThenOutputDoesNotHaveTheValue() {
		$this->_pass_kit->expects($this->any())->method('getLogoText');

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('logoText', $output));
	}

	/**
	 * @test
	 */
	public function whenLogoTextIsSetThenItIsDecoratedInTheCorrectKey() {
		$text = 'logo text';
		$this->_pass_kit->expects($this->any())->method('getLogoText')->will($this->returnValue($text));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($text, $output['logoText']);
	}

	/**
	 * @test
	 */
	public function suppressStripShineFlagIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getSuppressStripShine');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function suppressStripShineFlagIsInTheCorrectKeyInTheOutput() {
		$this->_pass_kit->expects($this->any())->method('getSuppressStripShine')->will($this->returnValue(true));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertTrue($output['suppressStripShine']);
	}

	/**
	 * @test
	 */
	public function barcodeFromPassKitIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getBarcode');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenBarcodeIsNotSetThenKeyIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('barcode', $output));
	}

	/**
	 * @test
	 */
	public function whenPassKitHasBarcodeDefinedThenItIsDecoratedInTheCorrectKey() {
		$barcode = $this->getMock('PHPassKit\Keys\LowerLevel\Barcode', array(), array(1, 'message', 'encoding'));
		$this->_pass_kit->expects($this->any())->method('getBarcode')->will($this->returnValue($barcode));

		$expected = 'decorator result';
		$this->_barcode_decorator->expects($this->once())->method('decorate')->will($this->returnValue($expected));
		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($expected, $output['barcode']);
	}
}