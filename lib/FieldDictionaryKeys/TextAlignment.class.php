<?php
class TextAlignment {
	const LEFT		= 1;
	const RIGHT		= 2;
	const CENTER	= 3;
	const NATURAL	= 4;

	static public function getConstName($alignment) {
		switch ($alignment) {
			case TextAlignment::LEFT:
				return 'PKTextAlignmentLeft';
				break;
			case TextAlignment::RIGHT:
				return 'PKTextAlignmentRight';
				break;
			case TextAlignment::CENTER:
				return 'PKTextAlignmentCenter';
				break;
			case TextAlignment::NATURAL:
				return 'PKTextAlignmentNatural';
				break;
		}
	}
}