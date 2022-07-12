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
	.container section img {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
</style>

<div class="container">
	<h1>Single sign on set up documentation</h1>
	<section>
		<h2>Step 1.</h2>
		<p>Open ADFS Management</p>
		<img src="img/1_open_adfs_management.png" />
	</section>
	<section>
		<h2>Step 2.</h2>
		<p>Add relying Party Trust</p>
		<img src="img/2_0_add_relying_party_trust.png" />
	</section>
	<section>
		<h2>Step 2.1.</h2>
		<p>Select "Claims aware"</p>
		<img src="img/2_1_welcome.png" />
	</section>
	<section>
		<h2>Step 2.2.</h2>
		<p>Download the service provider metadata from the privacy insights platform</p>
		<img src="img/2_2_download_sp_metadata.png" />
	</section>
	<section>
		<h2>Step 2.3.</h2>
		<p>Import the metadata.xml into the party trust</p>
		<img src="img/2_3_import_sp_metadata.png" />
	</section>
	<section>
		<h2>Step 2.4.</h2>
		<p>Name the party trust according to your avg register url, subdomain.domain.nl</p>
		<img src="img/2_4_specify_name.png" />
	</section>
	<section>
		<h2>Step 2.5.</h2>
		<p>Set access control policy to everyone</p>
		<img src="img/2_5_access_control_policy.png" />
	</section>
	<section>
		<h2>Step 2.6.</h2>
		<p>Press next</p>
		<img src="img/2_6_ready.png" />
	</section>
	<section>
		<h2>Step 2.7.</h2>
		<p>Press close</p>
		<img src="img/2_7_finish.png" />
	</section>
	<section>
		<h2>Step 3.</h2>
		<p>Edit Claim Issuance Policy</p>
		<img src="img/3_0_edit_claim_issuance_policy.png" />
	</section>
	<section>
		<h2>Step 3.1.</h2>
		<p>Add a new rule by pressing "Add rule..."</p>
		<img src="img/3_0_edit_claim_issuance_policy.png" />
	</section>
	<section>
		<h2>Step 3.2.</h2>
		<p>Choose as the claim rule template "Send LDAP Attributes as Claims"</p>
		<p>Press "Next"</p>
		<img src="img/3_2_send_ldap_attributes_as_claims.png" />
	</section>
	<section>
		<h2>Step 3.3.</h2>
		<p>Setup rule as you see in the picture and press Ok</p>
		<img src="img/3_3_rule_email.png.png" />
	</section>
	<section>
		<h2>Step 3.4.</h2>
		<p>Add a new rule by pressing "Add rule..."</p>
		<p>Choose as the claim rule template "Transform an Incoming Claim"</p>
		<p>Press "Next"</p>
		<img src="img/3_4_transform_an_incoming_claim.png" />
	</section>
	<section>
		<h2>Step 3.5.</h2>
		<p>Setup rule as you see in the picture and press Ok</p>
		<img src="img/3_5_transform_email_to_name_id.png" />
	</section>
	<section>
		<h2>Step 3.6.</h2>
		<p>Choose as the claim rule template "Send LDAP Attributes as Claims"</p>
		<p>Press "Next"</p>
		<img src="img/3_2_send_ldap_attributes_as_claims.png" />
	</section>
	<section>
		<h2>Step 3.7.</h2>
		<p>Setup rule as you see in the picture and press Ok</p>
		<img src="img/3_6_rule_email_as_login.png" />
	</section>
</div>
