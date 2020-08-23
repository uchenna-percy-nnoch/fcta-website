<?php 

class iconsult__Customize {

		public static function register( $wp_customize ) {
		
		} // eof register
		
		/**
		* This will output the custom WordPress settings to the live theme's WP head.
		*/
	    public static function header_output() {
			global $post,$iconsult_theme_options;
			echo '<style type="text/css">';
			
			/********
			* CONDITION
			********/
			
			// if bbpress active
			if ( class_exists('bbPress') && is_bbPress() ) {
				if ( bbp_is_forum_archive() ) {
					iconsult__bbpress_wp_default_settings();
				} else {
					iconsult__wp_default_settings();
				}
			} else 
			// If Woo Active
			if(function_exists("is_woocommerce") && (is_shop() || is_checkout() || is_account_page())){ 
				if(is_shop() ){
					$page_id = get_option('woocommerce_shop_page_id');
					iconsult__woo_shop_column_css_handler();		
				} elseif(is_checkout()) {
					$page_id = get_option('woocommerce_pay_page_id'); 
				} elseif(is_account_page()) {
					$page_id = get_option('woocommerce_myaccount_page_id'); 
				} elseif(is_account_page()) {
					$page_id = get_option('woocommerce_edit_address_page_id'); 
				} elseif(is_account_page()) {
					$page_id = get_option('woocommerce_view_order_page_id'); 
				}
				$woopage  = get_post( $page_id );
				if( isset($woopage->ID) && $woopage->ID != '' ) iconsult__page_post_customizer( $woopage->ID );
				else {}
				
			} else if(function_exists("is_product") && is_product()){
				
				if( $iconsult_theme_options['shop_header_layout'] == true ) {
					$page_id = get_option('woocommerce_shop_page_id');	
					$woopage  = get_post( $page_id );
					iconsult__page_post_customizer( $woopage->ID );
				} else {
					iconsult__wp_default_settings();
					iconsult__woo_replace_default_settings();
				}
				
			} else if(function_exists("is_product_category") && is_product_category()) {	
					
					iconsult__wp_default_settings();
					iconsult__woo_replace_default_settings();
					iconsult__woo_shop_column_css_handler();	
					
			// Normal WordPress	
			} else if( is_front_page() && is_home() ) {
				iconsult__wp_default_settings();
			} else if( is_front_page() ) {
				iconsult__page_post_customizer( get_the_ID() );
			} else if( is_home() ) {
				$blog_pgID = get_option('page_for_posts');
				iconsult__page_post_customizer( $blog_pgID );
			} else {
				if( is_page() ) { 
					iconsult__page_post_customizer( get_the_ID() );
				} else if( is_archive() ) {
					iconsult__wp_default_settings();
				} else if( is_single() ) { 
					iconsult__page_post_customizer( get_the_ID() );
				} else {  
					iconsult__wp_default_settings();
				}
			}
			
			/********
			* ONE TIME :: CALL ONLY ONCE
			********/
			iconsult__check_redux_plugin_install();
			
			/********
			* GLOBAL :: ALWAYS THIRD LAST
			********/
			iconsult__dynamic_settings();
			
			/********
			* GLOBAL :: ALWAYS SECOND LAST
			********/
			iconsult__vc_dynamic_css();
			
			/*****
			*  ALWAYS AT THE END LINE
			******/
			if( isset($iconsult_theme_options['theme-add-extra-css-code']) && $iconsult_theme_options['theme-add-extra-css-code'] != '' ) { echo esc_html($iconsult_theme_options['theme-add-extra-css-code']); }
			echo '</style>';
		}
		
		public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		  $return = '';
		  $mod = get_theme_mod($mod_name);
		  if ( ! empty( $mod ) ) {
			 $return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			 );
			 if ( $echo ) {
				echo ''.$return;
			 }
		  }
		  return $return;
		}
		
		
	   /**
		* This outputs the javascript needed to automate the live settings preview.
		*/
	   public static function live_preview() { }
		

}
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'iconsult__Customize' , 'register' ) );
// Output custom CSS to live site
add_action( 'wp_head' , array( 'iconsult__Customize' , 'header_output' ) );
// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'iconsult__Customize' , 'live_preview' ) );
?>