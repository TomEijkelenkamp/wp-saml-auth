<?php defined('ABSPATH') or die("you do not have acces to this page!");

class WP_SAML_Auth_PCA_Login {

	public static function initialize()
	{
		if ( !is_plugin_active('privacy-concepts-app/privacy-concepts-app.php') ) {
			die("Privacy concepts app not active!");
		}

		if ( get_option('wp_saml_auth_settings')['sso_active'] ) {
			add_action('pca_do_saml_form', array('WP_SAML_Auth_PCA_Login', 'add_sso_button'));
			add_action('wp_enqueue_scripts', array('WP_SAML_Auth_PCA_Login', 'enqueue_style_sso_button'));

			if ( ! get_option('wp_saml_auth_settings')['permit_wp_login'] ) {
				add_action('wp_enqueue_scripts', array('WP_SAML_Auth_PCA_Login', 'enqueue_style_hide_login'));
			}
		}
	}


	public static function add_sso_button()
	{
		$query_args  = array(
			'action' => 'wp-saml-auth',
		);

		$redirect_to = filter_input( INPUT_GET, 'redirect_to', FILTER_SANITIZE_URL );

		if ( $redirect_to ) {
			$query_args['redirect_to'] = rawurlencode( $redirect_to );
		}

		$href = esc_url( add_query_arg( $query_args, trailingslashit(site_url()).'wp-login.php' ) );
		$icon_src = plugin_dir_url(__FILE__) . 'img/MSFT_icon.png';

		echo "<a id='pca-sso-button' class='button' href='$href'><img class='msft-icon' src='$icon_src' /><span>Log in met Microsoft</span></a>";
	}


	public static function enqueue_style_sso_button() {
		wp_register_style(
			'sso-button', // handle name
			plugin_dir_url(__FILE__) . 'style/sso-button.css', // the URL of the stylesheet
			array(), // an array of dependent styles
			pca_version.time() // version number
		);
		wp_enqueue_style('sso-button');
	}


	public static function enqueue_style_hide_login() {
		wp_register_style(
			'hide-login', // handle name
			plugin_dir_url(__FILE__) . 'style/hide-login.css', // the URL of the stylesheet
			array(), // an array of dependent styles
			pca_version.time() // version number
		);
		wp_enqueue_style('hide-login');
	}

}
