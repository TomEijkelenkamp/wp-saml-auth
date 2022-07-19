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

	echo "<div id='wp-saml-auth-cta'><p><a class='button' href='$href'><img src='img/MSFT_icon.png' />Log in met saml</a></p></div>";
}

add_action('wp_enqueue_scripts', 'enqueue_style_sso_button');
function enqueue_style_sso_button() {
	wp_enqueue_style('sso-button-css', plugin_dir_url(__FILE__) . 'pca/style/sso-button.min.css');
}
