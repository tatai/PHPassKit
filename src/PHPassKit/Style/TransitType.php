<?php

namespace PHPassKit\Style;

class TransitType {
	const AIR 		= 1;
	const BOAT 		= 2;
	const BUS 		= 3;
	const GENERIC 	= 4;
	const TRAIN 	= 5;

	static public function getConstName($style) {
		switch ($style) {
			case DateStyle::AIR:
				return 'PKTransitTypeAir';
				break;
			case DateStyle::BOAT:
				return 'PKTransitTypeBoat';
				break;
			case DateStyle::BUS:
				return 'PKTransitTypeBus';
				break;
			case DateStyle::GENERIC:
				return 'PKTransitTypeGeneric';
				break;
			case DateStyle::TRAIN:
				return 'PKTransitTypeTrain';
				break;
		}
	}
}
