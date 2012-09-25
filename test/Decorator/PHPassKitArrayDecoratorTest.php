<?php

use PHPassKit\PHPassKit;
use PHPassKit\Decorator\PHPassKitArrayDecorator;
use PHPassKit\Decorator\CouponArrayDecorator;
use PHPassKit\Decorator\ArrayDecoratorManager;
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
	 * @var ArrayDecoratorManager
	 */
	private $_decorator_manager = null;

	public function setup() {
		$this->_pass_kit = $this->getMock('PHPassKit\PHPassKit', array(), array('a', 'a', 'a', 'a', 'a'));
		$this->_decorator_manager = $this->getMock('PHPassKit\Decorator\ArrayDecoratorManager', array(), array());
		$this->_decorator = new PHPassKitArrayDecorator($this->_decorator_manager);
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
		$this->_decorator_manager->expects($this->once())->method('decorate')->will($this->returnValue($expected));
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
		$this->_decorator_manager->expects($this->once())->method('decorate')->will($this->returnValue($expected));
		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals($expected, $output['barcode']);
	}

	/**
	 * @test
	 */
	public function locationsFromPassKitIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getLocations');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenLocationsIsNotSetThenKeyIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('locations', $output));
	}

	/**
	 * @test
	 */
	public function whenThereIsNoLocationsSetThenKeyIsNotPresentInTheOutput() {
		$this->_pass_kit->expects($this->any())->method('getLocations')->will($this->returnValue(array()));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('locations', $output));
	}

	/**
	 * @test
	 */
	public function whenPassKitHasAtLeastOneLocationDefinedThenItIsDecoratedInTheCorrectKey() {
		$location = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(0, 0));
		$this->_pass_kit->expects($this->any())->method('getLocations')->will($this->returnValue(array($location)));

		$expected = 'decorator result';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->returnValue($expected));
		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals(array($expected), $output['locations']);
	}

	/**
	 * @test
	 */
	public function whenPassKitHasMoreThanOneLocationDefinedThenTheyAreDecoratedInTheCorrectKey() {
		$location1 = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(1, 2));
		$location2 = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(3, 4));
		$this->_pass_kit->expects($this->any())->method('getLocations')->will($this->returnValue(array($location1, $location2)));

		$decorator1 = 'decorator result1';
		$decorator2 = 'decorator result1';
		$this->_decorator_manager->expects($this->any())->method('decorate')->will($this->onConsecutiveCalls($decorator1, $decorator2));
		$output = $this->_decorator->decorate($this->_pass_kit);

		$this->assertEquals(array($decorator1, $decorator2), $output['locations']);
	}

	/**
	 * @test
	 */
	public function associatedAppsFromPassKitIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getAssociatedApps');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenAssociatedAppsIsNotSetThenKeyIsNotPresentInTheOutput() {
		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('associatedStoreIdentifiers', $output));
	}

	/**
	 * @test
	 */
	public function whenThereIsNoAssociatedAppsSetThenKeyIsNotPresentInTheOutput() {
		$this->_pass_kit->expects($this->any())->method('getAssociatedApps')->will($this->returnValue(array()));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('associatedStoreIdentifiers', $output));
	}

	/**
	 * @test
	 */
	public function whenPassKitHasAssociatedAppsDefinedThenTheOutputHasTheCorrectKey() {
		$apps = array('id', 'another');
		$this->_pass_kit->expects($this->any())->method('getAssociatedApps')->will($this->returnValue($apps));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($apps, $output['associatedStoreIdentifiers']);
	}

	/**
	 * @test
	 */
	public function relevantDateFromPassKitIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getRelevantDate');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenRelevantDateIsNotSetThenItIsNotInTheOutput() {
		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('relevantDate', $output));
	}

	/**
	 * @test
	 */
	public function whenRelevantDateIsSetThenItIsInTheOutputInIso8601Format() {
		$timestamp = mktime(0, 0, 0, 9, 25, 2012);
		$this->_pass_kit->expects($this->any())->method('getRelevantDate')->will($this->returnValue($timestamp));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals(date('c', $timestamp), $output['relevantDate']);
	}

	/**
	 * @test
	 */
	public function webServiceUrlIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getWebServiceUrl');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenWebServiceIsNotGivenThenUrlKeyDoesNotExists() {
		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('webServiceURL', $output));
	}

	/**
	 * @test
	 */
	public function whenWebServiceIsGivenThenUrlKeyIsInTheOutput() {
		$url = 'http://url';
		$this->_pass_kit->expects($this->any())->method('getWebServiceUrl')->will($this->returnValue($url));
		$this->_pass_kit->expects($this->any())->method('getAuthenticationToken')->will($this->returnValue(''));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($url, $output['webServiceURL']);
	}

	/**
	 * @test
	 */
	public function webServiceAuthenticationTokenIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getAuthenticationToken');

		$this->_decorator->decorate($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function whenWebServiceIsNotGivenThenAuthenticationTokenKeyDoesNotExists() {
		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertFalse(array_key_exists('authenticationToken', $output));
	}

	/**
	 * @test
	 */
	public function whenWebServiceIsNotGivenThenAuthenticationTokenIsInTheOutput() {
		$token = 'token';
		$this->_pass_kit->expects($this->any())->method('getAuthenticationToken')->will($this->returnValue($token));
		$this->_pass_kit->expects($this->any())->method('getWebServiceUrl')->will($this->returnValue(''));

		$output = $this->_decorator->decorate($this->_pass_kit);
		$this->assertEquals($token, $output['authenticationToken']);
	}

}