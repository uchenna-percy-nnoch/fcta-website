<?php 
/* 
 * Plugin Name:   Iconsult Framework  
 * Version:       1.3
 * Plugin URI:    http://www.wpsmartapps.com/
 * Description:   <strong>Support iconsult wordpress theme</strong>.
 * Author:        Jabin Kadel
 * Author URI:    http://www.jabinkadel.com
 *
 * License: Copyright (c) 2018 WpSmartApps.com. All rights reserved.
 *  
 */

define( 'ICONSULTSUPPORT_PLUGIN', __FILE__ );
define( 'ICONSULTSUPPORT_PLUGIN_DIR', untrailingslashit( dirname( ICONSULTSUPPORT_PLUGIN ) ) );

/********************************
*** ACTIVATE PLUGIN ACTION  ***
***********************************/
$iconsult_framework_path     = preg_replace('/^.*wp-content[\\\\\/]plugins[\\\\\/]/', '', __FILE__);
$iconsult_framework_path     = str_replace('\\','/',$iconsult_framework_path);

// Langauge Support
add_action('plugins_loaded', 'iconsult__vc_support_load_textdomain');
function iconsult__vc_support_load_textdomain() {  
	load_plugin_textdomain( 'iconsult-framework', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

// Version Upgrade
add_action('activate_'.$iconsult_framework_path, 'iconsult__framework_plugin_active_version'); 
function iconsult__framework_plugin_active_version() {
	update_option( 'iconsult__framework_active_version', '1.3' );
	return true;
}

// widget
require ICONSULTSUPPORT_PLUGIN_DIR . '/widget/widget.php';
require ICONSULTSUPPORT_PLUGIN_DIR . '/widget/widget-social.php';


// Include Pages
require ICONSULTSUPPORT_PLUGIN_DIR . '/iconsult-post-type.php';
require ICONSULTSUPPORT_PLUGIN_DIR . '/iconsult-vc-support.php';
if(is_admin()) { 
	require ICONSULTSUPPORT_PLUGIN_DIR . '/admin/admin.php'; 
	require ICONSULTSUPPORT_PLUGIN_DIR . '/announcement/main.php'; 
}

/*-----------------------------------------------------------------------------------*/
/*	WOO :: SOCIAL SHARE
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'iconsult__woocommerce_social_share' ) ) {
function iconsult__woocommerce_social_share($url, $get = false, $align = 'center' ){
	global $iconsult_theme_options;
	if( isset($iconsult_theme_options['portfolio_social_share_mailto']) ){
		$mailto = esc_attr($iconsult_theme_options['portfolio_social_share_mailto']);
	} else {
		$mailto = '';
	}
	
	$return = '';
    $return .= '<div class="social-box" style="text-align:'.$align.'">
	<a target="_blank" href="https://twitter.com/home?status='. esc_url($url).'"><i class="fab fa-twitter social-share-box"></i></a>
    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='. esc_url($url).'" title="facebook"><i class="fab fa-facebook-f social-share-box"></i></a>
    <a target="_blank" href="https://pinterest.com/pin/create/button/?url='. esc_url($url).'&media=&description="><i class="fab fa-pinterest-p social-share-box"></i></a>
    <a target="_blank" href="https://plus.google.com/share?url='. esc_url($url).'"><i class="fab fa-google-plus-g social-share-box"></i></a>
    <a target="_blank" href="mailto:?subject='.$mailto.'"><i class="far fa-envelope social-share-box"></i></a>
    </div>';
	
	if( $get == true ) {
		return $return;
	} else {
		echo ''.$return;	
	}
    
}
}
?>