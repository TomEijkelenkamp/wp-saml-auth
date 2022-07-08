<?php

/**
 *  SAML Metadata view
 */

require_once('../../../../wp-load.php');
require_once '../vendor/autoload.php';
require_once 'settings.php';

try {
	$auth = new OneLogin\Saml2\Auth($settings);
	$settings = $auth->getSettings();

	$metadata = $settings->getSPMetadata();
	$errors = $settings->validateMetadata($metadata);
	if (empty($errors)) {
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private', false); // required for certain browsers
		header('Content-Type: text/xml');
		
		echo $metadata;

		exit;
	} else {
		throw new OneLogin\Saml2\Error(
			'Invalid SP metadata: ' . implode(', ', $errors),
			OneLogin\Saml2\Error::METADATA_SP_INVALID
		);
	}
} catch (Exception $e) {
	echo $e->getMessage();
}
