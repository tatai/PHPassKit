<?php

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

	public function __construct($description, $organizationName, $passTypeIdentifier, $serialNumber, $teamIdentifier) {
		$this->_description = $description;
		$this->_organization_name = $organizationName;
		$this->_pass_type_identifier = $passTypeIdentifier;
		$this->_serial_number = $serialNumber;
		$this->_team_identifier = $teamIdentifier;

		$this->_format_version = 1;
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
}