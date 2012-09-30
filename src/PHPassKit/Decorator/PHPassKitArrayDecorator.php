<?php

namespace PHPassKit\Decorator;

use PHPassKit\Common\PHPassKit;
use PHPassKit\Style\Coupon;
use PHPassKit\Style\BoardingPass;
use PHPassKit\Style\EventTicket;
use PHPassKit\Style\Generic;
use PHPassKit\Style\StoreCard;
use PHPassKit\Decorator\ArrayDecoratorManager;

class PHPassKitArrayDecorator {

	/**
	 * @var ArrayDecoratorManager
	 */
	private $_decorator_manager = null;

	public function __construct(ArrayDecoratorManager $decoratorManager) {
		$this->_decorator_manager = $decoratorManager;
	}

	/**
	 * Decorates PHPassKit as array
	 * 
	 * @return array
	 */
	public function decorate(PHPassKit $passKit) {
		$output = array(
			'description' => $passKit->getDescription(),
			'formatVersion' => $passKit->getFormatVersion(),
			'organizationName' => $passKit->getOrganizationName(),
			'passTypeIdentifier' => $passKit->getPassTypeIdentifier(),
			'serialNumber' => $passKit->getSerialNumber(),
			'teamIdentifier' => $passKit->getTeamIdentifier(),
			'suppressStripShine' => $passKit->getSuppressStripShine()
		);

		$style = $passKit->getStyle();
		if(!is_null($style)) {
			$key = null;
			if($style instanceof Coupon) {
				$key = 'coupon';
			}
			else if($style instanceof BoardingPass) {
				$key = 'boardingPass';
			}
			else if($style instanceof EventTicket) {
				$key = 'eventTicket';
			}
			else if($style instanceof Generic) {
				$key = 'generic';
			}
			else if($style instanceof StoreCard) {
				$key = 'storeCard';
			}

			if(!is_null($key)) {
				$output[$key] = $this->_decorator_manager->decorate($style);
			}
		}

		$barcode = $passKit->getBarcode();
		if(!is_null($barcode)) {
			$output['barcode'] = $this->_decorator_manager->decorate($barcode);
		}

		$associatedApps = $passKit->getAssociatedApps();
		if(is_array($associatedApps) && count($associatedApps) > 0) {
			$output['associatedStoreIdentifiers'] = $associatedApps;
		}

		$this->_decorateColor($output, 'backgroundColor', $passKit->getBackgroundColor());
		$this->_decorateColor($output, 'foregroundColor', $passKit->getForegroundColor());
		$this->_decorateColor($output, 'labelColor', $passKit->getLabelColor());

		$this->_setOptional($output, 'logoText', $passKit->getLogoText());

		$this->_decorateLocations($output, $passKit);

		$relevantDate = $passKit->getRelevantDate();
		if(!is_null($relevantDate)) {
			$output['relevantDate'] = date('c', $relevantDate);
		}

		$authenticationToken = $passKit->getAuthenticationToken();
		$webServiceUrl = $passKit->getWebServiceUrl();
		if(!is_null($authenticationToken) && !is_null($webServiceUrl)) {
			$output['authenticationToken'] = $authenticationToken;
			$output['webServiceURL'] = $webServiceUrl;
		}

		return $output;
	}

	private function _decorateColor(&$output, $key, $color = null) {
		if(!is_null($color) && is_array($color) && count($color) == 3) {
			$output[$key] = sprintf('rgb(%d, %d, %d)', $color[0], $color[1], $color[2]);
		}
	}

	private function _setOptional(&$output, $key, $value = null) {
		if(!is_null($value)) {
			$output[$key] = $value;
		}
	}

	private function _decorateLocations(&$output, PHPassKit $passKit) {
		$locations = $passKit->getLocations();

		if(is_array($locations) && count($locations) > 0) {
			$output['locations'] = array();
			foreach($locations as $location) {
				$output['locations'][] = $this->_decorator_manager->decorate($location);
			}
		}
	}
}