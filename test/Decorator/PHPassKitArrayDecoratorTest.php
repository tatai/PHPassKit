<?php

use PHPassKit\PHPassKit;
use PHPassKit\Decorator\PHPassKitArrayDecorator;

class PHPassKitArrayDecoratorTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var PHPassKit
	 */
	private $_pass_kit = null;

	/**
	 * @var PHPassKitArrayDecorator
	 */
	private $_decorator = null;

	public function setup() {
		$this->_pass_kit = $this->getMock('PHPassKit\PHPassKit', array(), array('a', 'a', 'a', 'a', 'a'));
		$this->_decorator = new PHPassKitArrayDecorator($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function descriptionIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getDescription');

		$this->_decorator->decorate();
	}

	/**
	 * @test
	 */
	public function descriptionIsInTheCorrectKey() {
		$description = 'PassKit description';
		$this->_pass_kit->expects($this->any())->method('getDescription')->will($this->returnValue($description));

		$output = $this->_decorator->decorate();

		$this->assertEquals($description, $output['description']);
	}

	/**
	 * @test
	 */
	public function formatVersionIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getFormatVersion');

		$this->_decorator->decorate();
	}

	/**
	 * @test
	 */
	public function formatVersionIsInTheCorrectKey() {
		$formatVersion = 'PassKit format version';
		$this->_pass_kit->expects($this->any())->method('getFormatVersion')->will($this->returnValue($formatVersion));

		$output = $this->_decorator->decorate();

		$this->assertEquals($formatVersion, $output['formatVersion']);
	}

	/**
	 * @test
	 */
	public function organizationNameIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getOrganizationName');

		$this->_decorator->decorate();
	}

	/**
	 * @test
	 */
	public function organizationNameIsInTheCorrectKey() {
		$organizationName = 'PassKit organization name';
		$this->_pass_kit->expects($this->any())->method('getOrganizationName')->will($this->returnValue($organizationName));

		$output = $this->_decorator->decorate();

		$this->assertEquals($organizationName, $output['organizationName']);
	}

	/**
	 * @test
	 */
	public function passTypeIdentifierIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getPassTypeIdentifier');

		$this->_decorator->decorate();
	}

	/**
	 * @test
	 */
	public function passTypeIdentifierIsInTheCorrectKey() {
		$passTypeIdentifier = 'PassKit pass type identifier';
		$this->_pass_kit->expects($this->any())->method('getPassTypeIdentifier')->will($this->returnValue($passTypeIdentifier));

		$output = $this->_decorator->decorate();

		$this->assertEquals($passTypeIdentifier, $output['passTypeIdentifier']);
	}

	/**
	 * @test
	 */
	public function serialNumberIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getSerialNumber');

		$this->_decorator->decorate();
	}

	/**
	 * @test
	 */
	public function serialNumberIsInTheCorrectKey() {
		$serialNumber = 'PassKit pass type identifier';
		$this->_pass_kit->expects($this->any())->method('getSerialNumber')->will($this->returnValue($serialNumber));

		$output = $this->_decorator->decorate();

		$this->assertEquals($serialNumber, $output['serialNumber']);
	}

	/**
	 * @test
	 */
	public function teamIdentifierIsUsed() {
		$this->_pass_kit->expects($this->once())->method('getTeamIdentifier');

		$this->_decorator->decorate();
	}

	/**
	 * @test
	 */
	public function teamIdentifierIsInTheCorrectKey() {
		$teamIdentifier = 'PassKit pass type identifier';
		$this->_pass_kit->expects($this->any())->method('getTeamIdentifier')->will($this->returnValue($teamIdentifier));

		$output = $this->_decorator->decorate();

		$this->assertEquals($teamIdentifier, $output['teamIdentifier']);
	}
}