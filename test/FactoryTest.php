<?php

use PHPassKit\Factory;
use PHPassKit\Generator\Builder;

class FactoryTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function builderReturnsABuilderObjectWithoutErrors() {
		$this->assertTrue(Factory::builder() instanceof Builder);
	}
}
