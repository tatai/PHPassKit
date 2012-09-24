<?php

namespace PHPassKit;

use PHPassKit\Style\Style;
use PHPassKit\Keys\LowerLevel\Barcode;

class PHPassKit {
	/**
	 * @var string
	 */
	private $_description = null;

	/**
	 * @var int
	 */
	private $_format_version = null;

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

	/**
	 * @var Style
	 */
	private $_style = null;

	/**
	 * @var array of string
	 */
	private $_files = null;

	/**
	 * @var array
	 */
	private $_background_color = null;

	/**
	 * @var array
	 */
	private $_foreground_color = null;

	/**
	 * @var array
	 */
	private $_label_color = null;

	/**
	 * @var string
	 */
	private $_logo_text = null;

	/**
	 * @var boolean
	 */
	private $_suppress_strip_shine = null;

	/**
	 * @var Barcode
	 */
	private $_barcode = null;

	public function __construct($description, $organizationName, $passTypeIdentifier, $serialNumber, $teamIdentifier) {
		$this->_description = $description;
		$this->_organization_name = $organizationName;
		$this->_pass_type_identifier = $passTypeIdentifier;
		$this->_serial_number = $serialNumber;
		$this->_team_identifier = $teamIdentifier;

		$this->_format_version = 1;
		$this->_suppress_strip_shine = false;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->_description;
	}

	/**
	 * @return int
	 */
	public function getFormatVersion() {
		return $this->_format_version;
	}

	/**
	 * @return string
	 */
	public function getOrganizationName() {
		return $this->_organization_name;
	}

	/**
	 * @return string
	 */
	public function getPassTypeIdentifier() {
		return $this->_pass_type_identifier;
	}

	/**
	 * @return string
	 */
	public function getSerialNumber() {
		return $this->_serial_number;
	}

	/**
	 * @return string
	 */
	public function getTeamIdentifier() {
		return $this->_team_identifier;
	}

	/**
	 * @param Style $style
	 */
	public function setStyle(Style $style) {
		$this->_style = $style;
	}

	/**
	 * @return Style
	 */
	public function getStyle() {
		return $this->_style;
	}

	/**
	 * @param string $path
	 */
	public function addFile($path) {
		$filename = basename($path);
		$this->_files[$filename] = $path;
	}

	/**
	 * @return array
	 */
	public function getFiles() {
		return $this->_files;
	}

	/**
	 * @param int $red 		red value 0..255
	 * @param int $green 	green value 0..255
	 * @param int $blue 	blue value 0..255
	 */
	public function setBackgroundColor($red, $green, $blue) {
		$this->_background_color = array($red, $green, $blue);
	}

	/**
	 * @return array
	 */
	public function getBackgroundColor() {
		return $this->_background_color;
	}

	/**
	 * @param int $red 		red value 0..255
	 * @param int $green 	green value 0..255
	 * @param int $blue 	blue value 0..255
	 */
	public function setForegroundColor($red, $green, $blue) {
		$this->_foreground_color = array($red, $green, $blue);
	}

	/**
	 * @return array
	 */
	public function getForegroundColor() {
		return $this->_foreground_color;
	}

	/**
	 * @param int $red 		red value 0..255
	 * @param int $green 	green value 0..255
	 * @param int $blue 	blue value 0..255
	 */
	public function setLabelColor($red, $green, $blue) {
		$this->_label_color = array($red, $green, $blue);
	}

	/**
	 * @return array
	 */
	public function getLabelColor() {
		return $this->_label_color;
	}

	/**
	 * @param string $text
	 */
	public function setLogoText($text) {
		$this->_logo_text = $text;
	}

	/**
	 * @return string
	 */
	public function getLogoText() {
		return $this->_logo_text;
	}

	/**
	 * @return boolean
	 */
	public function getSuppressStripShine() {
		return $this->_suppress_strip_shine;
	}

	/**
	 * @param boolean $suppress
	 */
	public function setSuppressStripShine($suppress) {
		$this->_suppress_strip_shine = $suppress;
	}

	/**
	 * @param Barcode $barcode
	 */
	public function setBarcode(Barcode $barcode) {
		$this->_barcode = $barcode;
	}

	/**
	 * @return Barcode
	 */
	public function getBarcode() {
		return $this->_barcode;
	}
}