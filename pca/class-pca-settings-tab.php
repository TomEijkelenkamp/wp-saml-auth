<?php defined('ABSPATH') or die("you do not have acces to this page!");

class WP_SAML_Auth_PCA_Settings_Tab {

	public static function initialize()
	{
        if ( !is_plugin_active('privacy-concepts-app/privacy-concepts-app.php') ) {
            die("Privacy concepts app not active!");
        }

        add_action('init', array('WP_SAML_Auth_PCA_Settings_Tab', 'add_fields'));
		add_filter('pca_field_get_value', array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_value_wp_saml_auth"), 10, 4);
		add_action('init', array('WP_SAML_Auth_PCA_Settings_Tab', 'save_tab_fields'));

		add_action("get_field_edit_sp_metadata", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_sp_metadata"), 10, 1);
		add_action("get_field_view_sp_metadata", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_sp_metadata"), 10, 1);
		add_action("get_field_edit_documentation", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_documentation"), 10, 1);
		add_action("get_field_view_documentation", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_documentation"), 10, 1);

        add_action('init', array('WP_SAML_Auth_PCA_Settings_Tab', 'save_reseller_account_tab_fields'));
	}

	/**
	 * Add fields to tab
	 */
    public static function add_fields()
	{
		global $pca_settings;

		/**
		 * Add tab to pca account settings
		 */
		$pca_settings->account_tabs["saml"] = __("Saml", "pca");

		/**
		 *  SSO Active
		 */
		$pca_settings->meta["saml"]["sso_active"] = array(
			"label" 	=> __("Active", "pca"),
			"fieldtype" => "checkbox",
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		$pca_settings->meta["saml"]["documentation"] = array(
			"label" 	=> __("Documentation", "pca"),
			"fieldtype" => "callback",
			"callback" 	=> "documentation",
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		/**
		 *  Identity Provider Provider Fields
		 */
		$pca_settings->meta["saml"]["idp_entityId"] = array(
			"label" 	=> __("Idp entity id", "pca"),
			"fieldtype" => "text",
			"verplicht" => true,
			"max" 		=> 0,
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		$pca_settings->meta["saml"]["idp_singleSignOnService_url"] = array(
			"label" 	=> __("Idp single sign on service url", "pca"),
			"fieldtype" => "text",
			"verplicht" => true,
			"max" 		=> 0,
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		$pca_settings->meta["saml"]["x509cert"] = array(
			"label" 	=> __("Idp certificate", "pca"),
			"fieldtype" => "textarea",
			"verplicht" => true,
			"max" 		=> 0,
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		/**
		 *  Service Provider Metadata
		 */
		$pca_settings->meta["saml"]["sp_metadata"] = array(
			"label" 	=> __("Sp metadata", "pca"),
			"fieldtype" => "callback",
			"callback" 	=> "sp_metadata",
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		/**
		 *  Lokale login
		 */
		$pca_settings->meta["saml"]["permit_wp_login"] = array(
			"label" 	=> __("Sta lokale login toe", "pca"),
			"fieldtype" => "checkbox",
			"roles" 	=> array(PCA_ADMINISTRATOR),
		);

		/**
		 *  Reseller Portal Fields
		 */
		$pca_settings->meta["subscription"]["saml"] = array(
			"label"     => __("SAML koppeling", "pca"),
			"fieldtype" => "checkbox",
			"roles"     => array('reseller'),
			"disabled"  => true,
			"condition" => array(
				"subscription" => PCA_ENTERPRISE,
			),
		);

		$pca_settings->meta["subscription"]["permit_wp_login"] = array(
			"label" 	=> __("Sta lokale login toe", "pca"),
			"fieldtype" => "checkbox",
			"roles"     => array('reseller'),
			"condition" => array(
				"saml" => "on"
			),
			"backend_condition" => array(
				"subscription" => PCA_ENTERPRISE,
			),
		);
	}


	/**
	 * Get values for pca saml fields from wp_saml_auth_settings for account saml
	 */
	public static function get_field_value_wp_saml_auth( $value, $fieldname, $data_item, $datatype )
	{
		if ( $datatype === 'saml' ) {
			$wp_saml_auth_settings = get_blog_option($data_item->blog_id, 'wp_saml_auth_settings');
			$wp_saml_auth_settings = wp_parse_args($wp_saml_auth_settings, self::get_default_settings());
			return isset($wp_saml_auth_settings[$fieldname]) ? esc_html($wp_saml_auth_settings[$fieldname]) : '';
		}

		if ( $datatype === 'subscription' && $fieldname === 'permit_wp_login') {
			$wp_saml_auth_settings = get_blog_option($data_item->blog_id, 'wp_saml_auth_settings');
			$wp_saml_auth_settings = wp_parse_args($wp_saml_auth_settings, self::get_default_settings());
			return isset($wp_saml_auth_settings['permit_wp_login']) ? esc_html($wp_saml_auth_settings['permit_wp_login']) : '';
		}

		if ( $datatype === 'subscription' && $fieldname === 'saml') {
			$wp_saml_auth_settings = get_blog_option($data_item->blog_id, 'wp_saml_auth_settings');
			$wp_saml_auth_settings = wp_parse_args($wp_saml_auth_settings, self::get_default_settings());
			return isset($wp_saml_auth_settings['sso_active']) ? esc_html($wp_saml_auth_settings['sso_active']) : '';
		}

		return $value;
	}


	/**
	 * Sanitize and save pca POST to wp_saml_auth_settings
	 */
    public static function save_tab_fields()
	{
		if ( isset($_POST['subtab']) && $_POST['subtab'] === "saml" ) {

			$wp_saml_auth_settings = get_option('wp_saml_auth_settings');
			$wp_saml_auth_settings = wp_parse_args($wp_saml_auth_settings, self::get_default_settings());

			$wp_saml_auth_settings['sso_active'] 					= isset($_POST['sso_active']) 					? sanitize_title($_POST['sso_active']) : '';
			$wp_saml_auth_settings['idp_entityId'] 					= isset($_POST['idp_entityId']) 				? esc_url($_POST['idp_entityId']) : '';
			$wp_saml_auth_settings['idp_singleSignOnService_url'] 	= isset($_POST['idp_singleSignOnService_url']) 	? esc_url($_POST['idp_singleSignOnService_url']) : '';
			$wp_saml_auth_settings['x509cert'] 						= isset($_POST['x509cert']) 					? sanitize_textarea_field($_POST['x509cert']) : '';
			$wp_saml_auth_settings['permit_wp_login'] 				= isset($_POST['permit_wp_login']) 				? sanitize_title($_POST['permit_wp_login']) : '';

			update_option('wp_saml_auth_settings', $wp_saml_auth_settings);
		}
	}

	/**
	 * Sanitize and save pca POST to wp_saml_auth_settings for reseller portal
	 */
    public static function save_reseller_account_tab_fields()
	{
		if ( isset($_POST['save-account']) && isset($_POST["token"]) && wp_verify_nonce($_POST["token"], "pca-nonce") && isset($_POST["list_account_id"]) && isset($_POST["permit_wp_login"]) )
		{
			global $pca_account;
			$blog_id = $pca_account->get_blog_id_by_account_id(intval($_POST["list_account_id"]));

			$wp_saml_auth_settings = get_blog_option($blog_id, 'wp_saml_auth_settings');
			$wp_saml_auth_settings['permit_wp_login'] = sanitize_title($_POST['permit_wp_login']);
			update_blog_option($blog_id, 'wp_saml_auth_settings', $wp_saml_auth_settings);
		}
	}


	public static function get_field_documentation()
	{
		$url = add_query_arg(['token' => wp_create_nonce("pca-nonce")], plugin_dir_url(__FILE__ ) . 'documentation.php?token=');

		?>
		<div class="form-control-no-input">
			<a target="_blank" class="btn btn-primary" href="<?php echo $url ?>"><?php _e("Documentation", "pca") ?></a>
		</div>
		<?php
	}


	public static function get_field_sp_metadata()
	{
		$wp_saml_auth_settings = get_option('wp_saml_auth_settings');
		$disabled = false;
		if ( empty($wp_saml_auth_settings['idp_entityId']) || empty($wp_saml_auth_settings['idp_singleSignOnService_url']) || empty($wp_saml_auth_settings['x509cert']) ) {
			$disabled = true;
		}

		$url = add_query_arg(['token' => wp_create_nonce("pca-nonce")], plugin_dir_url(__FILE__ ) . 'metadata.php?token=');

		?>
		<label><?php _e("Sp metadata", "pca") ?></label>
		<div class="form-control-no-input">
			<a target="_blank" class="btn btn-primary" href="<?php echo $url ?>" <?php echo ($disabled ? 'disabled' : '') ?>><?php _e("Download", "pca") ?></a>
			<?php echo ($disabled ? '<span>Vul de eerst verplichte velden in</span>' : '') ?>
		</div>
		<?php
	}


	public static function get_default_settings()
	{
		return [
			'auto_provision' => 1,
			'get_user_by' => 'email',
			'baseurl' => home_url(),
			'sp_entityId' => 'urn:' . parse_url( home_url(), PHP_URL_HOST ),
			'sp_assertionConsumerService_url' => home_url( '/wp-login.php' ),
			'idp_entityId' => '',
			'idp_singleSignOnService_url' => '',
			'idp_singleLogoutService_url' => '',
			'x509cert' => '',
			'certFingerprint' => '',
			'certFingerprintAlgorithm' => '',
			'user_login_attribute' => 'uid',
			'user_email_attribute' => 'email',
			'display_name_attribute' => 'display_name',
			'first_name_attribute' => 'first_name',
			'last_name_attribute' => 'last_name',
			'permit_wp_login' => 'on',
			'sso_active' => '',
		];
	}

}
