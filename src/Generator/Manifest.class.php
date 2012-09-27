<?php

namespace PHPassKit\Generator;

use PHPassKit\Common\PHPassKit;
use PHPassKit\Util\Hasher;

class Manifest {

	/**
	 * @var Hasher
	 */
	private $_hasher = null;

	public function __construct(Hasher $hasher) {
		$this->_hasher = $hasher;
	}

	public function create(PHPassKit $passKit) {
		$files = $passKit->getFiles();

		$output = array();

		if(is_array($files)) {
			foreach($files as $name => $filename) {
				$output[$name] = $this->_hasher->sha1(file_get_contents($filename));
			}
		}

		return $output;
	}
}