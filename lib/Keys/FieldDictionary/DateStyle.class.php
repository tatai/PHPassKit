<?php

namespace PHPassKit\Keys\FieldDictionary;

class DateStyle {
	const NONE 		= 1;
	const SHORT 	= 2;
	const MEDIUM 	= 3;
	const LONG 		= 4;
	const FULL 		= 5;

	static public function getConstName($style) {
		switch ($style) {
			case DateStyle::NONE:
				return 'PKDateStyleNone';
				break;
			case DateStyle::SHORT:
				return 'PKDateStyleShort';
				break;
			case DateStyle::MEDIUM:
				return 'PKDateStyleMedium';
				break;
			case DateStyle::LONG:
				return 'PKDateStyleLong';
				break;
			case DateStyle::FULL:
				return 'PKDateStyleFull';
				break;
		}
	}
}