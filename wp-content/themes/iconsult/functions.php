<?php
/**
* Set the content width based on the theme's design and stylesheet.
*/

if ( ! isset( $content_width ) ) $content_width = 700;

/*-----------------------------------------------------------------------------------*/
/*	Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'iconsult__setup' ) ) {
	function iconsult__setup() {
		
        /*	Load Text Domain */
		load_theme_textdomain( 'iconsult', trailingslashit( get_template_directory() ) . 'languages' );
		
        /*	Add Automatic Feed Links Support */
        add_theme_support( 'automatic-feed-links' );
		
        /* Add Post Formats Support */
        add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio'));
		
		/* Let WordPress manage the document title. */
		add_theme_support( 'title-tag' );
		
		/* Add Post Thumbnails Support and Related Image Sizes */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 825, 510, true );
		
		/** This theme uses wp_nav_menu() in one location. */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu',  'iconsult' ),
			'footer'  => esc_html__( 'Footer Menu',  'iconsult' ),
			'header-top-left'  => esc_html__( 'Header Top Left',  'iconsult' ),
		) );
		
		/** Custom image sizes */ 
		add_image_size( 'iconsult-image-700x525', 700, 525, true ); 
		if(function_exists("is_woocommerce")) { 
			add_image_size( 'iconsult-image-woo-400x300', 400, 300, true );
			add_image_size( 'iconsult-image-woo-400x600', 600, 600, true );
		}
		
		/*** If BBPress is active, add theme support */
		if ( class_exists( 'bbPress' ) ) { add_theme_support( 'bbpress' ); }

		
	}
}
add_action( 'after_setup_theme', 'iconsult__setup' );

/*-----------------------------------------------------------------------------------*/
/*	Include Theme Options Framework
/*-----------------------------------------------------------------------------------*/
require_once( trailingslashit( get_template_directory() ) . 'framework/ReduxCore/options/iconsult.php' );

/*-----------------------------------------------------------------------------------*/
/*	Add MetaBox Library :: CMB2
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/meta-field/kb-meta.php';
require trailingslashit( get_template_directory() ) . 'framework/meta-field/page-meta.php';
require trailingslashit( get_template_directory() ) . 'framework/meta-field/custom-meta.php';

/*-----------------------------------------------------------------------------------*/
/*	Re-Write iconsult
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/customizer.php';
/*-----------------------------------------------------------------------------------*/
/*	MENU
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/include/menu.php';
/*-----------------------------------------------------------------------------------*/
/*	SUPPORT FUNCTION
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/include/functions.php';
/*-----------------------------------------------------------------------------------*/
/*	HOOK
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/include/hook.php';
/*-----------------------------------------------------------------------------------*/
/*	TAGS
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/include/template-tags.php';
/*-----------------------------------------------------------------------------------*/
/*	IMPORT
/*-----------------------------------------------------------------------------------*/ 
require trailingslashit( get_template_directory() ) . 'framework/import/one-click-import.php';
/*-----------------------------------------------------------------------------------*/
/*	WOOCOMMERCE
/*-----------------------------------------------------------------------------------*/
require trailingslashit( get_template_directory() ) . 'woocommerce/woocommerce_configuration.php';


/*-----------------------------------------------------------------------------------*/
/*	CHECKER SR PLUGIN
/*-----------------------------------------------------------------------------------*/ 
$is_plugin_revslider_active = iconsult__plugin_active('RevSliderFront');
if ( $is_plugin_revslider_active == true ) {
global $revSliderVersion;
if( version_compare( $revSliderVersion, '5.4.8.3', '<' ) ) {
	add_action('admin_notices', 'iconsult__plugin_slider_revolution_update_notify');
}
}
function iconsult__plugin_slider_revolution_update_notify() {
$allowed_html_array = array('a' => array('href' => array(),'title' => array()),'br' => array(),'div' => array('class' => array('bind_adminmsg'),),'strong' => array(),'span' => array(),);
printf( wp_kses( __('<div class="bind_adminmsg"><span>PLEASE UPGRADE "Slider Revolution" to new version 5.4.8.3</span> <br><br> 1. Go to: Plugins -> Installed Plugins. <br>2. <strong>DELETE plugin</strong> "Slider Revolution" for the system. <strong><i>(you must DEACTIVATE plugin first and DELETE it)</i></strong> <br> 3. <strong>Click on "Begin installing plugin" -OR - go to "Apperance > Install Plugins"</strong>, to install new version.</span> <br><br><i>Note: No data will be loss in this upgrade process.</i> </div>', 'iconsult' ), $allowed_html_array) );
}


/*-----------------------------------------------------------------------------------*/
/*	ACTIVATE VC
/*-----------------------------------------------------------------------------------*/
$is_plugin_js_composer_active = iconsult__plugin_active('Vc_Manager');
if ( $is_plugin_js_composer_active == true ) {
	// check the latest vc version
	if( version_compare(WPB_VC_VERSION, '5.7', '<' ) ) {
		add_action('admin_notices', 'iconsult__plugin_vc_update_notify');
	}
	require trailingslashit( get_template_directory() ) . 'framework/vc-include/row.php';
	require trailingslashit( get_template_directory() ) . 'framework/vc.php';
}

function iconsult__plugin_vc_update_notify() {
$allowed_html_array = array('a' => array('href' => array(),'title' => array()),'br' => array(),'div' => array('class' => array('bind_adminmsg'),),'strong' => array(),'span' => array(),);
printf( wp_kses( __('<div class="bind_adminmsg"><span>PLEASE UPGRADE "WPBakery Visual Composer" to new version 5.7</span> <br><br> 1. Go to: Plugins -> Installed Plugins. <br>2. <strong>DELETE plugin</strong> "WPBakery Visual Composer" for the system. <strong><i>(you must DEACTIVATE plugin first and DELETE it)</i></strong> <br> 3. <strong>Click on "Begin installing plugin" -OR - go to "Apperance > Install Plugins"</strong>, to install new version. <strong></span> <br><br><i>Note: No data will be loss in this upgrade process.</i> </div>', 'iconsult' ), $allowed_html_array) );
}

/*-----------------------------------------------------------------------------------*/
/*	ICONSULT FRAMEWORK UPDATE CHECKER
/*-----------------------------------------------------------------------------------*/ 
$iconsult_framework_version_check = "1.3"; 
$is_plugin_required_fortheme_active = iconsult__chkfunction_plugin_active('iconsult__portfolio_post_type');
if ( $is_plugin_required_fortheme_active == true ) {
	$db_plugin_framework_version = get_option( 'iconsult__framework_active_version' );
	if( $db_plugin_framework_version != $iconsult_framework_version_check || $db_plugin_framework_version == '' ) {  
		add_action('admin_notices', 'iconsult__plugin_iconsult_framework_notify');
	}
}

function iconsult__plugin_iconsult_framework_notify() {
$allowed_html_array = array('a' => array('href' => array(),'title' => array()),'br' => array(),'div' => array('class' => array('bind_adminmsg'),),'strong' => array(),'span' => array(),);
printf( wp_kses( __('<div class="bind_adminmsg"><span>PLEASE UPGRADE "Iconsult Framework (Post Type)" to new version 1.3</span> <br><br> 1. Go to: Plugins -> Installed Plugins. <br>2. <strong>DELETE plugin</strong> "iconsult Framework (Post Type)" for the system. <strong><i>(you must DEACTIVATE plugin first and DELETE it)</i></strong> <br> 3. <strong>Click on "Begin installing plugin" -OR - go to "Apperance > Install Plugins"</strong>, to install new version.</span> <br><br><i>Note: No data will be loss in this upgrade process.</i> </div>', 'iconsult' ), $allowed_html_array) );
}


/*-----------------------------------------------------------------------------------*/
/*	Ultimate_VC_Addons
/*-----------------------------------------------------------------------------------*/ 
$is_plugin_ultimate_addons_for_wpbakery_page_builder_active = iconsult__plugin_active('Ultimate_VC_Addons');
if ( $is_plugin_ultimate_addons_for_wpbakery_page_builder_active == true ) { 
	// check the latest vc version
	if( version_compare(ULTIMATE_VERSION, '3.18.0', '<' ) ) {
		add_action('admin_notices', 'iconsult__plugin_ultimate_addons_for_wpbakery_update_notify');
	}
}

function iconsult__plugin_ultimate_addons_for_wpbakery_update_notify() {
$allowed_html_array = array('a' => array('href' => array(),'title' => array()),'br' => array(),'div' => array('class' => array('bind_adminmsg'),),'strong' => array(),'span' => array(),);
printf( wp_kses( __('<div class="bind_adminmsg"><span>PLEASE UPGRADE "Ultimate Addons for WPBakery Page Builder" to new version 3.18.0</span> <br><br> 1. Go to: Plugins -> Installed Plugins. <br>2. <strong>DELETE plugin</strong> "Ultimate Addons for WPBakery Page Builder" for the system. <strong><i>(you must DEACTIVATE plugin first and DELETE it)</i></strong> <br> 3. <strong>Click on "Begin installing plugin" -OR - go to "Apperance > Install Plugins"</strong>, to install new version.</span> <br><br><i>Note: No data will be loss in this upgrade process.</i> </div>', 'iconsult' ), $allowed_html_array) );
}
?>