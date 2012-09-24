<?php

namespace PHPassKit\Decorator;

use PHPassKit\PHPassKit;
use PHPassKit\Style\Coupon;

class PHPassKitArrayDecorator {

	/**
	 * @var CouponArrayDecorator
	 */
	private $_coupon_decorator = null;

	public function __construct(CouponArrayDecorator $couponDecorator) {
		$this->_coupon_decorator = $couponDecorator;
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

		$this->_decorateColor($output, 'backgroundColor', $passKit->getBackgroundColor());
		$this->_decorateColor($output, 'foregroundColor', $passKit->getForegroundColor());
		$this->_decorateColor($output, 'labelColor', $passKit->getLabelColor());

		$logoText = $passKit->getLogoText();
		if(!is_null($logoText)) {
			$output['logoText'] = $logoText;
		}

		return $output;
	}

	private function _decorateColor(&$output, $key, $color = null) {
		if(!is_null($color) && is_array($color) && count($color) == 3) {
			$output[$key] = sprintf('rgb(%d, %d, %d)', $color[0], $color[1], $color[2]);
		}
	}
}