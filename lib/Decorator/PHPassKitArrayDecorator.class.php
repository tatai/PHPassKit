<?php

namespace PHPassKit\Decorator;

use PHPassKit\PHPassKit;

class PHPassKitArrayDecorator {
	/**
	 * @var PHPassKit
	 */
	private $_pass_kit = null;

	public function __construct(PHPassKit $passKit) {
		$this->_pass_kit = $passKit;
	}

	/**
	 * Decorates PHPassKit as array
	 * 
	 * @return array
	 */
	public function decorate() {
		return array(
			'description' => $this->_pass_kit->getDescription(),
			'formatVersion' => $this->_pass_kit->getFormatVersion(),
			'organizationName' => $this->_pass_kit->getOrganizationName(),
			'passTypeIdentifier' => $this->_pass_kit->getPassTypeIdentifier(),
			'serialNumber' => $this->_pass_kit->getSerialNumber(),
			'teamIdentifier' => $this->_pass_kit->getTeamIdentifier()
		);
	}
}