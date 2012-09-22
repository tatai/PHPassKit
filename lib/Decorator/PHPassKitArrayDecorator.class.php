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
			'teamIdentifier' => $passKit->getTeamIdentifier()
		);

		$style = $passKit->getStyle();
		if(!is_null($style) && $style instanceof Coupon) {
			$output['coupon'] = $this->_coupon_decorator->decorate($style);
		}

		return $output;
	}
}