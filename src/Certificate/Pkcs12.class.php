<?php

namespace PHPassKit\Certificate;

class Pkcs12 {
	/**
	 * Reads PKCS#12 data and returns the certificate data and the private key
	 * 
	 * @param  string 	$pkcs12
	 * @param  string 	$password
	 * 
	 * @return array 	with 'certificate' and 'private-key' values
	 */
	public function read($pkcs12, $password) {
		$certs = array();
		if(openssl_pkcs12_read($pkcs12, $certs, $password) == true) {

			$certData = openssl_x509_read($certs['cert']);
			$privateKey = openssl_pkey_get_private($certs['pkey'], $password);

			return array(
				'certificate' => $certData,
				'private-key' => $privateKey
			);
		}

		return null;
	}

	/**
	 * Signs a file and saves signature to file
	 * 
	 * @param  string 	$fileToSign 	path to the file to sign
	 * @param  string 	$saveTo 		path where signature file is saved
	 * @param  resource $certificate
	 * @param  string 	$privateKey
	 * 
	 * @return boolean 	true on success, false otherwise
	 */
	public function sign($fileToSign, $saveTo, $certificate, $privateKey, $extraCerts = null) {
		if(!is_null($extraCerts)) {
			return openssl_pkcs7_sign($fileToSign, $saveTo, $certificate, $privateKey, array(), PKCS7_BINARY | PKCS7_DETACHED, $extraCerts);
		}

		return openssl_pkcs7_sign($fileToSign, $saveTo, $certificate, $privateKey, array(), PKCS7_BINARY | PKCS7_DETACHED);
	}

	/**
	 * Converts pem data to der format
	 * 
	 * @param  string $pem pem data
	 * 
	 * @return string pem data converted to der format
	 */
	public function convertPemToDer($pem) {
		$begin = "filename=\"smime.p7s\"\n";
		$end = "\n\n-----";

		$pem = substr($pem, strpos($pem, $begin)+strlen($begin));    
		$pem = substr($pem, 0, strpos($pem, $end));
		return base64_decode($pem);
	}

}
