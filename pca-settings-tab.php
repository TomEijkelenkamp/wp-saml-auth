<?php defined('ABSPATH') or die("you do not have acces to this page!");

if ( !is_plugin_active('privacyinsights/privacy-concepts-app.php') && !is_plugin_active('privacy-concepts-app/privacy-concepts-app.php') ) {
	die("Privacy concepts app not active!");
}

global $pca_settings;


/**
 * Initialize tab
 */
$pca_settings->account_tabs["saml"] = __("Saml", "pca");


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


add_action('init', 'pca_save_saml_tab_fields');
function pca_save_saml_tab_fields() {
	error_log(print_r(get_option('wp_saml_auth_settings'), true));
}
