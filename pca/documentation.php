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
	<h2>Step 6.</h2>
	<p>Set access control policy to everyone</p>
	<img src="img/docu_6_access_control.png" />
	<h2>Step 7.</h2>
	<p>Press next</p>
	<img src="img/docu_7_trust_ready.png" />
	<h2>Step 8.</h2>
	<p>Press close</p>
	<img src="img/docu_8_trust_finish.png" />
	<h2>Step 9.</h2>
	<p>Edit </p>
	<img src="img/docu_9_claim_issuance.png" />
	<h2>Step 10.</h2>
	<p>Press close</p>
	<img src="img/docu_10_add_ldap.png" />
	<h2>Step 11.</h2>
	<p>Press close</p>
	<img src="img/docu_11_rule_email.png" />
	<h2>Step 12.</h2>
	<p>Press close</p>
	<img src="img/docu_12_add_transform.png" />
	<h2>Step 13.</h2>
	<p>Press close</p>
	<img src="img/docu_13_transform_email.png" />
	<h2>Step 14.</h2>
	<p>Press close</p>
	<img src="img/docu_14_add_ldap.png" />
	<h2>Step 15.</h2>
	<p>Press close</p>
	<img src="img/docu_15_rule_login.png" />
</div>
