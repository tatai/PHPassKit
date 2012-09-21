<?php

namespace PHPassKit\Decorator;

use PHPassKit\PHPassKit;

class PHPassKitArrayDecorator {

	/**
	 * Decorates PHPassKit as array
	 * 
	 * @return array
	 */
	public function decorate(PHPassKit $passKit) {
		return array(
			'description' => $passKit->getDescription(),
			'formatVersion' => $passKit->getFormatVersion(),
			'organizationName' => $passKit->getOrganizationName(),
			'passTypeIdentifier' => $passKit->getPassTypeIdentifier(),
			'serialNumber' => $passKit->getSerialNumber(),
			'teamIdentifier' => $passKit->getTeamIdentifier()
		);
	}
}