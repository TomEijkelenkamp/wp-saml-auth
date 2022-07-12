<?php

add_action('pca_do_saml_form', 'add_sso_button');
function add_sso_button()
{
	$query_args  = array(
		'action' => 'wp-saml-auth',
	);

	$redirect_to = filter_input( INPUT_GET, 'redirect_to', FILTER_SANITIZE_URL );

	if ( $redirect_to ) {
		$query_args['redirect_to'] = rawurlencode( $redirect_to );
	}

	$href = esc_url( add_query_arg( $query_args, trailingslashit(site_url()).'wp-login.php' ) );

	echo "<div id='wp-saml-auth-cta'><p><a class='button' href='$href'>Log in met saml</a></p></div>";
}
