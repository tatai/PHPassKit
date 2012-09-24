<?php

use PHPassKit\Util\Hasher;

class HasherTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function sha1ReturnsThatTypeOfHasOfTheGivenData() {
		$data = 'test data to hash with sha1';
		$hasher = new Hasher();

		$this->assertEquals(sha1($data), $hasher->sha1($data));
	}
}