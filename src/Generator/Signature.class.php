<?php

namespace PHPassKit\Generator;

use PHPassKit\Certificate\Pkcs12;

class Signature {
	/**
	 * @var string
	 */
	private $_certificate = null;

	/**
	 * @var string
	 */
	private $_password = null;

	/**
	 * @var string
	 */
	private $_cache_folder = null;

	/**
	 * @var Pkcs12
	 */
	private $_pkcs12 = null;

	/**
	 * @var string
	 */
	private $_wwdr_file = null;

	/**
	 * 
	 * @param string	$certificate 	path to PKCS#12 certificate file
	 * @param string	$password 		password to open certificate file
	 * @param Pkcs12 	$pkcs12 		PKCS#12 utilities
	 */
	public function __construct($certificate, $password, Pkcs12 $pkcs12) {
		$this->_certificate = $certificate;
		$this->_password = $password;
		$this->_pkcs12 = $pkcs12;

		$this->_cache_folder = __DIR__ . '/../../cache';
		$this->_wwdr_file = __DIR__ . '/../../data/AppleWWDR.pem';
	}

	public function setCacheFolder($path) {
		$this->_cache_folder = $path;
	}

	/**
	 * Creates the signature file for manifest.
	 *
	 * If $signaturePath is not set, then a 'signature' file will be created in
	 * the same folder as manifest file
	 *
	 * @param 	string 	$manifestFilePath 	path to the manifest file
	 * @param 	string 	$signaturePath 		full path where signature will be saved
	 *
	 * @throws PHPassKitException when process cannot be completed
	 */
	public function create($manifestFilePath, $signaturePath = null) {
		$data = $this->_loadCertificate();

		$certificate = $data['certificate'];
		$privateKey = $data['private-key'];

		if(is_null($signaturePath)) {
			$signaturePath = dirname($manifestFilePath) . DIRECTORY_SEPARATOR . 'signature';
		}

		if(!$this->_pkcs12->sign($manifestFilePath, $signaturePath, $certificate, $privateKey, $this->_wwdr_file)) {
			throw new PHPassKitException('Cannot create signature for manifest');
		}

		$signature = file_get_contents($signaturePath);
		file_put_contents($signaturePath, $this->_pkcs12->convertPemToDer($signature));
	}

	/**
	 * Loads certificate and private key
	 * 
	 * @return array 	with 'certificate' and 'private-key' values
	 */
	private function _loadCertificate() {
		/*
		$certCache = $this->_cache_folder . DIRECTORY_SEPARATOR . basename($this->_certificate) . '.cert-cache';
		$privateKeyCache = $this->_cache_folder . DIRECTORY_SEPARATOR . basename($this->_certificate) . '.priv-key-cache';

		if(file_exists($certCache) && file_exists($privateKeyCache)) {
			return array(
				'certificate' => file_get_contents($certCache),
				'private-key' => file_get_contents($privateKeyCache)
			);
		}

		$this->_checkIfCacheFolderIsReadable();
		 */

		$data = $this->_pkcs12->read(file_get_contents($this->_certificate), $this->_password);

		//file_put_contents($certCache, $data['certificate']);
		//file_put_contents($privateKeyCache, $data['private-key']);

		return $data;
	}

	private function _checkIfCacheFolderIsReadable() {
		if(!file_exists($this->_cache_folder)) {
			@mkdir($this->_cache_folder);
		}

		if(!is_writable($this->_cache_folder)) {
			throw new \Exception('Cache folder ' . $this->_cache_folder . ' is not readable');
		}
	}

	/**
	 * Sets the path to the Apple Worldwide Developer Relations certificate
	 * 
	 * @param string $wwdrPath path to the file
	 */
	public function setAppleWWDR($wwdrPath) {
		$this->_wwdr_file = $wwdrPath;
	}

	/**
	 * Disables package signing with the Apple Worldwide Developer Relations
	 * certificate. If done, PassKits can be created and download into iOS6
	 * devices and simulator, but just simulator can add it to PassBook. Trying
	 * to add a non-signed Passkit into iOS 6 devices will cause error
	 */
	public function disableWWDRCertificate() {
		$this->_wwdr_file = null;
	}

}