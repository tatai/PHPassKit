<?php

namespace PHPassKit\Keys\FieldDictionary;

class NumberStyle {
	const DECIMAL		= 1;
	const PERCENT		= 2;
	const SCIENTIFIC	= 3;
	const SPELLOUT		= 4;

	static public function getConstName($style) {
		switch ($style) {
			case DateStyle::DECIMAL:
				return 'PKNumberStyleDecimal';
				break;
			case DateStyle::PERCENT:
				return 'PKNumberStylePercent';
				break;
			case DateStyle::SCIENTIFIC:
				return 'PKNumberStyleScientific';
				break;
			case DateStyle::SPELLOUT:
				return 'PKNumberStyleSpellOut';
				break;
		}
	}
}