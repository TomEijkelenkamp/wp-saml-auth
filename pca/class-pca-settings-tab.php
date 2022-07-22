<?php defined('ABSPATH') or die("you do not have acces to this page!");

class WP_SAML_Auth_PCA_Settings_Tab {

	public static function initialize()
	{
        if ( !is_plugin_active('privacy-concepts-app/privacy-concepts-app.php') ) {
            die("Privacy concepts app not active!");
        }

        add_action('init', array('WP_SAML_Auth_PCA_Settings_Tab', 'add_tab'));
        add_action('init', array('WP_SAML_Auth_PCA_Settings_Tab', 'add_fields'));
        add_action('init', array('WP_SAML_Auth_PCA_Settings_Tab', 'save_tab_fields'));

		add_action("get_field_edit_sp_metadata", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_sp_metadata"), 10, 1);
		add_action("get_field_view_sp_metadata", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_sp_metadata"), 10, 1);
		add_action("get_field_edit_documentation", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_documentation"), 10, 1);
		add_action("get_field_view_documentation", array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_documentation"), 10, 1);

		add_filter('pca_field_get_value', array('WP_SAML_Auth_PCA_Settings_Tab', "get_field_value_wp_saml_auth"), 10, 4);
	}


	/**
	 * Add tab to pca account settings
	 */
    public static function add_tab()
	{
		global $pca_settings;
		$pca_settings->account_tabs["saml"] = __("Saml", "pca");
	}


	/**
	 * Add fields to tab
	 */
    public static function add_fields()
	{
		global $pca_settings;

		/**
		 *  Service Provider Fields
		 */
		$pca_settings->meta["saml"]["documentation"] = array(
			"label" => __("Documentation", "pca"),
			"fieldtype" => "callback",
			"callback" => "documentation",
		);

		/**
		 *  Service Provider Fields
		 */
		$pca_settings->meta["saml"]["sp_metadata"] = array(
			"label" => __("Sp metadata", "pca"),
			"fieldtype" => "callback",
			"callback" => "sp_metadata",
		);

		/**
		 *  Identity Provider Provider Fields
		 */
		$pca_settings->meta["saml"]["idp_entity_id"] = array(
			"label" => __("Idp entity id", "pca"),
			"fieldtype" => "text",
			"verplicht" => true,
			"max" => 0,
			"roles" => array(4),//4 = beheerder
		);

		$pca_settings->meta["saml"]["idp_single_sign_on_service_url"] = array(
			"label" => __("Idp single sign on service url", "pca"),
			"fieldtype" => "text",
			"verplicht" => true,
			"max" => 0,
			"roles" => array(4),//4 = beheerder
		);

		$pca_settings->meta["saml"]["idp_certificate"] = array(
			"label" => __("Idp certificate", "pca"),
			"fieldtype" => "textarea",
			"verplicht" => true,
			"max" => 0,
			"roles" => array(4),//4 = beheerder
		);
	}


	/**
	 * Sanitize and save pca POST to wp_saml_auth_settings
	 */
    public static function save_tab_fields()
	{
		if ( isset($_POST['subtab']) && $_POST['subtab'] === "saml" ) {

			$wp_saml_auth_settings = get_option('wp_saml_auth_settings');

			if ( isset($_POST['idp_entity_id']) ) {
				$wp_saml_auth_settings['idp_entityId'] = esc_url($_POST['idp_entity_id']);
			}

			if ( isset($_POST['idp_single_sign_on_service_url']) ) {
				$wp_saml_auth_settings['idp_singleSignOnService_url'] = esc_url($_POST['idp_single_sign_on_service_url']);
			}

			if ( isset($_POST['idp_certificate']) ) {
				$wp_saml_auth_settings['x509cert'] = sanitize_textarea_field($_POST['idp_certificate']);
			}

			update_option('wp_saml_auth_settings', $wp_saml_auth_settings);

		}
	}


	/**
	 * Get values for pca saml fields from wp_saml_auth_settings
	 */
    public static function get_field_value_wp_saml_auth( $value, $fieldname, $data_item, $datatype )
	{
		if ( $datatype === 'saml' ) {

			$wp_saml_auth_settings = get_option('wp_saml_auth_settings');

			if ( $fieldname === 'idp_entity_id' ) {
				return $wp_saml_auth_settings['idp_entityId'];
			}

			if ( $fieldname === 'idp_single_sign_on_service_url' ) {
				return $wp_saml_auth_settings['idp_singleSignOnService_url'];
			}

			if ( $fieldname === 'idp_certificate' ) {
				return $wp_saml_auth_settings['x509cert'];
			}

		}

		return $value;
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
		$url = add_query_arg(['token' => wp_create_nonce("pca-nonce")], plugin_dir_url(__FILE__ ) . 'metadata.php?token=');

		?>
		<label><?php _e("Sp metadata", "pca") ?></label>
		<div class="form-control-no-input">
			<a target="_blank" class="btn btn-primary" href="<?php echo $url ?>"><?php _e("Download", "pca") ?></a>
		</div>
		<?php
	}

}
