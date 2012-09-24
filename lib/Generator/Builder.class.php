<?php

namespace PHPassKit\Generator;

use PHPassKit\PHPassKit;
use PHPassKit\Generator\Manifest;
use PHPassKit\Generator\Signature;
use PHPassKit\Decorator\PHPassKitArrayDecorator;

class Builder {
	/**
	 * @var Manifest
	 */
	private $_manifest = null;

	/**
	 * @var PHPassKitArrayDecorator
	 */
	private $_decorator = null;

	/**
	 * @var string
	 */
	private $_tmp_path = null;

	public function __construct(PHPassKitArrayDecorator $decorator, Manifest $manifest) {
		$this->_decorator = $decorator;
		$this->_manifest = $manifest;

		$this->_tmp_path = sys_get_temp_dir();
	}

	public function setTmpPath($path) {
		$this->_tmp_path = $path;
	}

	public function create(PHPassKit $passKit, $saveTo, Signature $signature) {
		$passFolder = tempnam($this->_tmp_path, 'passkit.pass');
		@unlink($passFolder);
		mkdir($passFolder);

		// Copy files
		foreach($passKit->getFiles() as $name => $file) {
			copy($file, $passFolder . DIRECTORY_SEPARATOR . $name);
		}

		// Create passkit data
		$data = $this->_decorator->decorate($passKit);

		// Create pass.json in target folder
		$passJsonFilePath = $passFolder . DIRECTORY_SEPARATOR . 'pass.json';
		file_put_contents($passJsonFilePath, json_encode($data));

		// Add pass.json file to passkit as file
		$passKit->addFile($passJsonFilePath);

		// Create manifest
		$manifest = $this->_manifest->create($passKit);

		// Create manifest.json in target folder
		$manifestFilePath = $passFolder . DIRECTORY_SEPARATOR  . 'manifest.json';
		file_put_contents($manifestFilePath, json_encode($manifest));

		// Sign passkit
		$signaturePath = $passFolder . DIRECTORY_SEPARATOR  . 'signature';
		$this->_signPassKit($signature, $manifestFilePath, $signaturePath);

		// Compress passkit => file.passkit
		return $this->_createZip($passKit, $saveTo, $signaturePath, $manifestFilePath);
	}

	private function _signPassKit(Signature $signature, $manifestFilePath, $signaturePath) {
		$signature->create($manifestFilePath, $signaturePath);
	}

	private function _createZip(PHPassKit $passkit, $passkitPath, $signaturePath, $manifestPath) {
		$zip = new \ZipArchive();
		if(!$zip->open($passkitPath, \ZipArchive::CREATE)) {
			return false;
		}

		$zip->addFile($signaturePath, 'signature');
		$zip->addFile($manifestPath, 'manifest.json');

		foreach($passkit->getFiles() as $name => $file) {
			$zip->addFile($file, $name);
		}
		$zip->close();

		return $passkitPath;
	}
}