<?php

/**
 *  SAML documentation for client implementation
 */

require_once('../../../../wp-load.php');

header('Content-Type: text/html');

?>
<div>
	<h1>Single sign on set up documentation</h1>
	<h2>Step 1.</h2>
	<p>Open ADFS Management</p>
	<img src="img/docu_1_adfs.png" />
	<h2>Step 2.</h2>
	<p>Add relying Party Trust</p>
	<img src="img/docu_2_add_trust.png" />
	<h2>Step 3.</h2>
	<p>Download the service provider metadata from the privacy insights platform</p>
	<img src="img/docu_3_sp_metadata.png" />
	<h2>Step 4.</h2>
	<p>Import the metadata.xml into the party trust</p>
	<img src="img/docu_4_import_metadata.png" />
	<h2>Step 5.</h2>
	<p>Name the party trust according to your avg register url, subdomain.domain.nl</p>
	<img src="img/docu_5_name_trust.png" />
</div>
