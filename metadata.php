<?php

require_once('../../../wp-load.php');
require_once 'vendor/autoload.php';

try {
	$auth = new OneLogin\Saml2\Auth();
	$settings = $auth->getSettings();
	$metadata = $settings->getSPMetadata();
	$errors = $settings->validateMetadata($metadata);
	if (empty($errors)) {
		header('Content-Type: text/xml');
		echo $metadata;
	} else {
		throw new OneLogin\Saml2\Error(
			'Invalid SP metadata: '.implode(', ', $errors),
			OneLogin\Saml2\Error::METADATA_SP_INVALID
		);
	}
} catch (Exception $e) {
	echo $e->getMessage();
}
