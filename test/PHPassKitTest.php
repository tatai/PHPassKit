<?php

use PHPassKit\PHPassKit;
use PHPassKit\Style\Coupon;
use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\Keys\LowerLevel\Location;

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

	/**
	 * @test
	 */
	public function backgroundColorCanBeRetrieved() {
		$color = array(21, 43, 199);
		$this->_pass_kit->setBackgroundColor($color[0], $color[1], $color[2]);

		$this->assertEquals($color, $this->_pass_kit->getBackgroundColor());
	}

	/**
	 * @test
	 */
	public function foregroundColorCanBeRetrieved() {
		$color = array(0, 21, 255);
		$this->_pass_kit->setForegroundColor($color[0], $color[1], $color[2]);

		$this->assertEquals($color, $this->_pass_kit->getForegroundColor());
	}

	/**
	 * @test
	 */
	public function labelColorCanBeRetrieved() {
		$color = array(54, 193, 23);
		$this->_pass_kit->setLabelColor($color[0], $color[1], $color[2]);

		$this->assertEquals($color, $this->_pass_kit->getLabelColor());
	}

	/**
	 * @test
	 */
	public function logoTextCanBeRetrieved() {
		$logoText = 'logo text';
		$this->_pass_kit->setLogoText($logoText);

		$this->assertEquals($logoText, $this->_pass_kit->getLogoText());
	}

	/**
	 * @test
	 */
	public function defaultValueOfSuppressStripShineIsFalse() {
		$this->assertFalse($this->_pass_kit->getSuppressStripShine());
	}

	/**
	 * @test
	 */
	public function whenSuppressStripShineIsChangedThenItsValueCanBeRetrieved() {
		$this->_pass_kit->setSuppressStripShine(true);

		$this->assertTrue($this->_pass_kit->getSuppressStripShine());
	}

	/**
	 * @test
	 */
	public function whenBarcodeIsSetThenItCanBeRetrieved() {
		$barcode = $this->getMock('PHPassKit\Keys\LowerLevel\Barcode', array(), array(1, 'message', 'encoding'));
		$this->_pass_kit->setBarcode($barcode);

		$this->assertEquals($barcode, $this->_pass_kit->getBarcode());
	}

	/**
	 * @test
	 */
	public function whenNoLocationIsGivenThenValueIsAnEmptyArray() {
		$this->assertEquals(array(), $this->_pass_kit->getLocations());
	}

	/**
	 * @test
	 */
	public function whenOneLocationIsGivenThenItCanBeReturnedInLocationsArray() {
		$location = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(1, 2));
		$this->_pass_kit->addLocation($location);

		$this->assertEquals(array($location), $this->_pass_kit->getLocations());
	}

	/**
	 * @test
	 */
	public function whenSeveralLocationsAreGivenThenTheyCanBeReturnedInLocationsArray() {
		$location1 = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(1, 2));
		$this->_pass_kit->addLocation($location1);
		$location2 = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(3, 4));
		$this->_pass_kit->addLocation($location2);
		$location3 = $this->getMock('PHPassKit\Keys\LowerLevel\Location', array(), array(5, 6));
		$this->_pass_kit->addLocation($location3);

		$this->assertEquals(array($location1, $location2, $location3), $this->_pass_kit->getLocations());
	}

	/**
	 * @test
	 */
	public function whenNoAssociateAppIsGivenThenNullIsReturned() {
		$this->assertNull($this->_pass_kit->getAssociatedApps());
	}

	/**
	 * @test
	 */
	public function whenOneAssociatedAppIsGivenThenItCanBeReturnedInTheListOfAssociatedApps() {
		$id = 'ASDF1234';
		$this->_pass_kit->addAssociatedApp($id);

		$this->assertEquals(array($id), $this->_pass_kit->getAssociatedApps());
	}

	/**
	 * @test
	 */
	public function whenSeveralAssociatedAppsAreGivenThenTheyCanBeReturnedInTheListOfAssociatedApps() {
		$id1 = 'ASDF1234';
		$this->_pass_kit->addAssociatedApp($id1);
		$id2 = 'KSL32';
		$this->_pass_kit->addAssociatedApp($id2);
		$id3 = '09SPOJH2';
		$this->_pass_kit->addAssociatedApp($id3);

		$this->assertEquals(array($id1, $id2, $id3), $this->_pass_kit->getAssociatedApps());
	}

	/**
	 * @test
	 */
	public function whenRelevantDateIsNotSetThenReturnsNull() {
		$this->assertNull($this->_pass_kit->getRelevantDate());
	}

	/**
	 * @test
	 */
	public function whenRelevantDateIsGivenAsYearMonthAndDayThenItCanBeReturned() {
		$date = '2012-09-25';
		$this->_pass_kit->setRelevantDate($date);

		$this->assertEquals(mktime(0, 0, 0, 9, 25, 2012), $this->_pass_kit->getRelevantDate());
	}

	/**
	 * @test
	 */
	public function whenRelevantDateIsGivenAsTimestampThenItCanBeReturned() {
		$timestamp = 1348562693;
		$this->_pass_kit->setRelevantDate($timestamp);

		$this->assertEquals($timestamp, $this->_pass_kit->getRelevantDate());
	}

	/**
	 * @test
	 */
	public function whenRelevantDateIsNotGivenInTheCorrectFormatThenItReturnsNull() {
		$date = 'Sep 25, 2012';
		$this->_pass_kit->setRelevantDate($date);

		$this->assertNull($this->_pass_kit->getRelevantDate());
	}
}
