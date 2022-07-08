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

		$pca_settings->meta["saml"]["idp_single_logout_service_url"] = array(
			"label" => __("Idp single logout service url", "pca"),
			"fieldtype" => "text",
			"verplicht" => true,
			"max" => 0,
			"roles" => array(4),//4 = beheerder
		);

		$pca_settings->meta["saml"]["idp_certificate"] = array(
			"label" => __("Idp certificate", "pca"),
			"fieldtype" => "text",
			"verplicht" => true,
			"max" => 0,
			"roles" => array(4),//4 = beheerder
		);
	}

    public static function save_tab_fields()
	{
		error_log(print_r(get_option('wp_saml_auth_settings'), true));
	}

	public static function get_field_sp_metadata()
	{
		$url = add_query_arg(['token' => wp_create_nonce("pca-nonce")], plugin_dir_url(__FILE__ ) . 'metadata.php?token=');

		?>
		<label><?php _e("metadata.xml", "pca") ?></label>
		<div class="form-control-no-input">
			<a target="_blank" class="btn btn-primary" href="<?php echo $url ?>"><?php _e("Download", "pca") ?></a>
		</div>
		<?php
	}

}
