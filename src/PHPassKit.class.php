<?php

namespace PHPassKit;

use PHPassKit\Style\Style;
use PHPassKit\Keys\LowerLevel\Barcode;
use PHPassKit\PHPassKitException;

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
	 * @var array of int
	 */
	private $_background_color = null;

	/**
	 * @var array of int
	 */
	private $_foreground_color = null;

	/**
	 * @var array of int
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

	/**
	 * @var array of Location
	 */
	private $_locations = null;

	/**
	 * @var array of string
	 */
	private $_associated_apps = null;

	/**
	 * 
	 * @var string
	 */
	private $_relevant_date = null;

	/**
	 * @var string
	 */
	private $_web_service_url = null;

	/**
	 * @var string
	 */
	private $_authentication_token = null;

	public function __construct($description, $organizationName, $passTypeIdentifier, $serialNumber, $teamIdentifier) {
		$this->_description = $description;
		$this->_organization_name = $organizationName;
		$this->_pass_type_identifier = $passTypeIdentifier;
		$this->_serial_number = $serialNumber;
		$this->_team_identifier = $teamIdentifier;

		$this->_format_version = 1;
		$this->_suppress_strip_shine = false;
		$this->_locations = array();
		$this->_files = array();
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

	/**
	 * @param Location $location
	 */
	public function addLocation($location) {
		$this->_locations[] = $location;
	}

	/**
	 * @return array
	 */
	public function getLocations() {
		return $this->_locations;
	}

	/**
	 * @return array of string
	 */
	public function getAssociatedApps() {
		return $this->_associated_apps;
	}

	/**
	 * @param string $appId Adam ID
	 */
	public function addAssociatedApp($appId) {
		$this->_associated_apps[] = $appId;
	}

	/**
	 * Returns the relevant date (if defined) in YYYY-MM-DD format
	 * 
	 * @return string
	 */
	public function getRelevantDate() {
		return $this->_relevant_date;
	}

	/**
	 * Sets the relevant date. Use YYYY-MM-DD format or timestamp
	 * 
	 * @param string $date YYYY-MM-DD or timestamp
	 *
	 * @throws  PHPassKitException
	 */
	public function setRelevantDate($date) {
		if(preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})/', $date, $matches)) {
			$this->_relevant_date = mktime(0, 0, 0, $matches[2], $matches[3], $matches[1]);
		}
		else if(preg_match('/^[0-9]+$/', $date)) {
			$this->_relevant_date = $date;
		}
		else {
			throw new PHPassKitException('Date does not have the correct format. Use YYYY-MM-DD or timestamp');
		}
	}

	/**
	 * @return string
	 */
	public function getWebServiceUrl() {
		return $this->_web_service_url;
	}

	/**
	 * @return string
	 */
	public function getAuthenticationToken() {
		return $this->_authentication_token;
	}

	/**
	 * @param string $url
	 * @param string $token
	 *
	 * @throws  PHPassKitException
	 */
	public function setWebService($url, $token) {
		if(strlen($token) < 16) {
			throw new PHPassKitException('Web service authentication token must be 16 characters or longer');
		}

		$this->_web_service_url = $url;
		$this->_authentication_token = $token;
	}
}