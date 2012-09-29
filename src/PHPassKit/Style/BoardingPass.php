<?php

namespace PHPassKit\Style;

class BoardingPass extends Style {
	/**
	 * @var int @see TransitType
	 */
	private $_transit_type = null;

	public function __construct($transitType) {
		parent::__construct(array('header', 'primary', 'secondary', 'auxiliary', 'back'));
		$this->_transit_type = $transitType;
	}

	public function getTransitType() {
		return $this->_transit_type;
	} 
}