<?php

use PHPassKit\Generator\Manifest;
use PHPassKit\PHPassKit;
use PHPassKit\Util\Hasher;

class ManifestTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var PHPassKit
	 */
	private $_pass_kit = null;

	/**
	 * @var Manifest
	 */
	private $_manifest = null;

	/**
	 * @var Hasher
	 */
	private $_hasher = null;

	public function setup() {
		$this->_pass_kit = $this->getMock('PHPassKit\PHPassKit', array(), array('a', 'a', 'a', 'a', 'a'));
		$this->_hasher = $this->getMock('PHPassKit\Util\Hasher');
		$this->_manifest = new Manifest($this->_hasher);
	}

	/**
	 * @test
	 */
	public function filesFromPassKitAreRetrieved() {
		$this->_pass_kit->expects($this->once())->method('getFiles');

		$this->_manifest->create($this->_pass_kit);
	}

	private function _createFilename() {
		return tempnam(sys_get_temp_dir(), 'manifest_test_');
	}

	/**
	 * @test
	 */
	public function thereIsOneEntryInTheOutputForEachFileGivenByPassKit() {
		$file1 = $this->_createFilename();
		$file2 = $this->_createFilename();
		$file3 = $this->_createFilename();
		$this->_pass_kit->expects($this->any())->method('getFiles')->will($this->returnValue(array($file1, $file2, $file3)));

		$output = $this->_manifest->create($this->_pass_kit);
		$this->assertEquals(3, count($output));

		unlink($file1);
		unlink($file2);
		unlink($file3);
	}

	/**
	 * @test
	 */
	public function whenFilesIsNotAValidArrayThenHasherIsNotUsed() {
		$this->_hasher->expects($this->exactly(0))->method('sha1');

		$this->_manifest->create($this->_pass_kit);
	}

	/**
	 * @test
	 */
	public function sha1MethodOfhasherIsUsedOneTimeForEachFile() {
		$file1 = $this->_createFilename();
		$file2 = $this->_createFilename();
		$file3 = $this->_createFilename();
		$this->_pass_kit->expects($this->any())->method('getFiles')->will($this->returnValue(array($file1, $file2, $file3)));
		$this->_hasher->expects($this->exactly(3))->method('sha1');

		$this->_manifest->create($this->_pass_kit);

		unlink($file1);
		unlink($file2);
		unlink($file3);
	}

	/**
	 * @test
	 */
	public function whenOneFileIsGivenThenThatFileIsInTheOutputWithItsSha1() {
		$filename = $this->_createFilename();
		$basename = basename($filename);
		$expected = 'sha1 result';
		$this->_pass_kit->expects($this->any())->method('getFiles')->will($this->returnValue(array($basename => $filename)));
		$this->_hasher->expects($this->any())->method('sha1')->will($this->returnValue($expected));

		$output = $this->_manifest->create($this->_pass_kit);
		$this->assertEquals(array($basename => $expected), $output);

		unlink($filename);
	}

	/**
	 * @test
	 */
	public function whenSeveralFilesAreGivenThenEachFileIsInTheOutputWithItsSha1() {
		$filename1 = $this->_createFilename();
		$basename1 = basename($filename1);
		$expected1 = 'sha1 result of filename1';

		$filename2 = $this->_createFilename();
		$basename2 = basename($filename2);
		$expected2 = 'sha1 result of filename2';

		$filename3 = $this->_createFilename();
		$basename3 = basename($filename3);
		$expected3 = 'sha1 result of filename3';

		$this->_pass_kit->expects($this->any())->method('getFiles')->will($this->returnValue(array($basename1 => $filename1, $basename2 => $filename2, $basename3 => $filename3)));
		$this->_hasher->expects($this->any())->method('sha1')->will($this->onConsecutiveCalls($expected1, $expected2, $expected3));

		$output = $this->_manifest->create($this->_pass_kit);
		$this->assertEquals(array($basename1 => $expected1, $basename2 => $expected2, $basename3 => $expected3), $output);

		unlink($filename1);
		unlink($filename2);
		unlink($filename3);
	}
}