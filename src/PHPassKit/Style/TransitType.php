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
			case TransitType::AIR:
				return 'PKTransitTypeAir';
				break;
			case TransitType::BOAT:
				return 'PKTransitTypeBoat';
				break;
			case TransitType::BUS:
				return 'PKTransitTypeBus';
				break;
			case TransitType::GENERIC:
				return 'PKTransitTypeGeneric';
				break;
			case TransitType::TRAIN:
				return 'PKTransitTypeTrain';
				break;
		}
	}
}
