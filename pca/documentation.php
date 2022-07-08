<?php

/**
 *  SAML documentation for client implementation
 */

require_once('../../../../wp-load.php');

header('Content-Type: text/html');

?>
<style>
	.container {
		margin: 50px;
	}
	.container section {
		margin: 50px 0;
	}
</style>
<div class="container">
	<h1>Single sign on set up documentation</h1>
	<section>
		<h2>Step 1.</h2>
		<p>Open ADFS Management</p>
		<img src="img/docu_1_adfs.png" />
	</section>
	<section>
		<h2>Step 2.</h2>
		<p>Add relying Party Trust</p>
		<img src="img/docu_2_add_trust.png" />
	</section>
	<section>
		<h2>Step 3.</h2>
		<p>Download the service provider metadata from the privacy insights platform</p>
		<img src="img/docu_3_sp_metadata.png" />
	</section>
	<section>
		<h2>Step 4.</h2>
		<p>Import the metadata.xml into the party trust</p>
		<img src="img/docu_4_import_metadata.png" />
	</section>
	<section>
		<h2>Step 5.</h2>
		<p>Name the party trust according to your avg register url, subdomain.domain.nl</p>
		<img src="img/docu_5_name_trust.png" />
	</section>
	<section>
		<h2>Step 6.</h2>
		<p>Set access control policy to everyone</p>
		<img src="img/docu_6_access_control.png" />
	</section>
	<section>
		<h2>Step 7.</h2>
		<p>Press next</p>
		<img src="img/docu_7_trust_ready.png" />
	</section>
	<section>
		<h2>Step 8.</h2>
		<p>Press close</p>
		<img src="img/docu_8_trust_finish.png" />
	</section>
	<section>
		<h2>Step 9.</h2>
		<p>Edit Claim Issuance Policy</p>
		<img src="img/docu_9_claim_issuance.png" />
	</section>
	<section>
		<h2>Step 10.</h2>
		<p>Set claim rule template to "Send LDAP Attributes as Claims"</p>
		<img src="img/docu_10_add_ldap.png" />
	</section>
	<section>
		<h2>Step 11.</h2>
		<p>Setup rule as you see in the picture and press Ok</p>
		<img src="img/docu_11_rule_email.png" />
	</section>
	<section>
		<h2>Step 12.</h2>
		<p>Add another rule and set the claim rule template to "Transform an Incoming Claim"</p>
		<img src="img/docu_12_add_transform.png" />
	</section>
	<section>
		<h2>Step 13.</h2>
		<p>Setup rule as you see in the picture and press Ok</p>
		<img src="img/docu_13_transform_email.png" />
	</section>
	<section>
		<h2>Step 14.</h2>
		<p>Add another rule and set claim rule template to "Send LDAP Attributes as Claims"</p>
		<img src="img/docu_14_add_ldap.png" />
	</section>
	<section>
		<h2>Step 15.</h2>
		<p>Setup rule as you see in the picture and press Ok</p>
		<img src="img/docu_15_rule_login.png" />
	</section>
</div>
