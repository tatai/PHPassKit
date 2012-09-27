<?php

namespace PHPassKit\Decorator;

use PHPassKit\Keys\LowerLevel\Location;

class LocationArrayDecorator {
	public function decorate(Location $location) {
		$output = array(
			'latitude' => $location->getLatitude(),
			'longitude' => $location->getLongitude()
		);

		$this->_setOptional($output, 'altitude', $location->getAltitude());
		$this->_setOptional($output, 'relevantText', $location->getRelevantText());

		return $output;
	}

	private function _setOptional(&$output, $key, $value = null) {
		if(!is_null($value)) {
			$output[$key] = $value;
		}
	}
}