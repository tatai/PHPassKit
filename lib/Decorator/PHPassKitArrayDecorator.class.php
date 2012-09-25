<?php

namespace PHPassKit\Decorator;

use PHPassKit\PHPassKit;
use PHPassKit\Style\Coupon;
use PHPassKit\Decorator\CouponArrayDecorator;
use PHPassKit\Decorator\BarcodeArrayDecorator;
use PHPassKit\Decorator\LocationArrayDecorator;

class PHPassKitArrayDecorator {

	/**
	 * @var CouponArrayDecorator
	 */
	private $_coupon_decorator = null;

	/**
	 * @var BarcodeArrayDecorator
	 */
	private $_barcode_decorator = null;

	/**
	 * @var LocationArrayDecorator
	 */
	private $_location_decorator = null;

	public function __construct(CouponArrayDecorator $couponDecorator, BarcodeArrayDecorator $barcodeDecorator, LocationArrayDecorator $locationDecorator) {
		$this->_coupon_decorator = $couponDecorator;
		$this->_barcode_decorator = $barcodeDecorator;
		$this->_location_decorator = $locationDecorator;
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
		if(!is_null($style) && $style instanceof Coupon) {
			$output['coupon'] = $this->_coupon_decorator->decorate($style);
		}

		$barcode = $passKit->getBarcode();
		if(!is_null($barcode)) {
			$output['barcode'] = $this->_barcode_decorator->decorate($barcode);
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
				$output['locations'][] = $this->_location_decorator->decorate($location);
			}
		}
	}
}