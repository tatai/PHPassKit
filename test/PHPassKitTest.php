<?php

use PHPassKit\PHPassKit;
use PHPassKit\Style\Coupon;

class PHPassKitTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var PHPassKit
	 */
	private $_pass_kit = null;

	/**
	 * @var string
	 */
	private $_description = null;

	/**
	 * @var string
	 */
	private $_organization_name = null;

	/**
	 * @var string
	 */
	private $_pass_type_identifier = null;

	/**
	 * @var string
	 */
	private $_serial_number = null;

	/**
	 * @var string
	 */
	private $_team_identifier = null;
	
	public function setup() {
		$this->_description = 'description';
		$this->_organization_name = 'organization name';
		$this->_pass_type_identifier = 'pass type identifier';
		$this->_serial_number = 'serial number';
		$this->_team_identifier = 'team identifier';
		$this->_pass_kit = new PHPassKit($this->_description, $this->_organization_name, $this->_pass_type_identifier, $this->_serial_number, $this->_team_identifier);
	}

	/**
	 * @test
	 */
	public function descriptionCanBeReturned() {
		$this->assertEquals($this->_description, $this->_pass_kit->getDescription());
	}

	/**
	 * @test
	 */
	public function formatVersionIsOne() {
		$this->assertEquals(1, $this->_pass_kit->getFormatVersion());
	}

	/**
	 * @test
	 */
	public function organizationNameCanBeRetrived() {
		$this->assertEquals($this->_organization_name, $this->_pass_kit->getOrganizationName());
	}

	/**
	 * @test
	 */
	public function passTypeIdentifierCanBeReturned() {
		$this->assertEquals($this->_pass_type_identifier, $this->_pass_kit->getPassTypeIdentifier());
	}

	/**
	 * @test
	 */
	public function serialNumberCanBeReturned() {
		$this->assertEquals($this->_serial_number, $this->_pass_kit->getSerialNumber());
	}

	/**
	 * @test
	 */
	public function teamIdentifierIsGivenThenItCanBeReturned() {
		$this->assertEquals($this->_team_identifier, $this->_pass_kit->getTeamIdentifier());
	}

	/**
	 * @test
	 */
	public function whenStyleIsGivenThenItCanBeReturned() {
		$style = $this->getMock('PHPassKit\Style\Coupon');
		$this->_pass_kit->setStyle($style);

		$this->assertEquals($style, $this->_pass_kit->getStyle());
	}

	/**
	 * @test
	 */
	public function whenOneFileIsAddedThenItsPathCanBeRetrieved() {
		$path = '/path/to/file';
		$this->_pass_kit->addFile($path);

		$files = $this->_pass_kit->getFiles();
		$this->assertEquals(array('file' => $path), $files);
	}

	/**
	 * @test
	 */
	public function whenMoreThanOneFileIsAddedThenAllFilesCanBeRetrived() {
		$path1 = '/path/to/file1';
		$this->_pass_kit->addFile($path1);
		$path2 = '/path/to/file2';
		$this->_pass_kit->addFile($path2);

		$files = $this->_pass_kit->getFiles();
		$this->assertEquals(array('file1' => $path1, 'file2' => $path2), $files);
	}

	/**
	 * @test
	 */
	public function whenOneFileIsAddedAndItAlreadyExistsInBundleThenItReplacesTheExistingOne() {
		$path1 = '/path/to/file1';
		$this->_pass_kit->addFile($path1);
		$path2 = '/another/path/to/file1';
		$this->_pass_kit->addFile($path2);

		$files = $this->_pass_kit->getFiles();
		$this->assertEquals(array('file1' => $path2), $files);
	}
}