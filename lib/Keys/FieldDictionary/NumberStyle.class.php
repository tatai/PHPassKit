<?php

namespace PHPassKit\Keys\FieldDictionary;

class NumberStyle {
	const DECIMAL		= 1;
	const PERCENT		= 2;
	const SCIENTIFIC	= 3;
	const SPELLOUT		= 4;

	static public function getConstName($style) {
		switch ($style) {
			case NumberStyle::DECIMAL:
				return 'PKNumberStyleDecimal';
				break;
			case NumberStyle::PERCENT:
				return 'PKNumberStylePercent';
				break;
			case NumberStyle::SCIENTIFIC:
				return 'PKNumberStyleScientific';
				break;
			case NumberStyle::SPELLOUT:
				return 'PKNumberStyleSpellOut';
				break;
		}
	}
}