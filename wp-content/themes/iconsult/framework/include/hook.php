<?php 

/*-----------------------------------------------------------------------------------*/
/*	THEME FAVICON
/*-----------------------------------------------------------------------------------*/ 

function iconsult__header_call() {
	global $iconsult_theme_options;
	if(!empty($iconsult_theme_options['general_bind_theme_favicon']['url'])){  
		echo '<link href="'.esc_url($iconsult_theme_options['general_bind_theme_favicon']['url']).'" rel="shortcut icon">'; 
	}
}
add_action('wp_head', 'iconsult__header_call');




/*-----------------------------------------------------------------------------------*/
/*	Enqueue scripts and styles.
/*-----------------------------------------------------------------------------------*/ 
function iconsult__scripts() {
	
	global $woocommerce, $iconsult_theme_options;
	
	// Internet Explorer HTML5 support 
    wp_enqueue_script( 'html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', array(), '3.7.3', false);
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    // Internet Explorer 8 media query support
    wp_enqueue_script( 'respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
	

	// other support
	wp_enqueue_script( 'bootstrap', trailingslashit(get_template_directory_uri()) . 'js/lib/bootstrap.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-flexslider', trailingslashit(get_template_directory_uri()) . 'js/flexslider/jquery.flexslider.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-parallax-min', trailingslashit( get_template_directory_uri() ) . 'js/parallax/parallax.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-parallax', trailingslashit( get_template_directory_uri() ) . 'js/parallax/parallax.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'owl-carousel', trailingslashit( get_template_directory_uri() ) . 'js/owl/owl.carousel.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'masonry', trailingslashit( get_template_directory_uri() ) . 'js/masonry-docs.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'isotope', trailingslashit( get_template_directory_uri() ) . 'js/isotope/isotope.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-imagesloaded', trailingslashit( get_template_directory_uri() ) . 'js/isotope/imagesloaded.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-mediaelement', trailingslashit( get_template_directory_uri() ) . 'js/mediaelement/mediaelement.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-lightbox', trailingslashit( get_template_directory_uri() ) . 'js/lightbox/lightbox.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-appear', trailingslashit( get_template_directory_uri() ) . 'js/appear.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-timer', trailingslashit( get_template_directory_uri() ) . 'js/timer.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-advsearch', trailingslashit( get_template_directory_uri() ) . 'js/advsearch.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-lazyload', trailingslashit( get_template_directory_uri() ) . 'js/lazyload/lazyload.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-js-magnific', trailingslashit( get_template_directory_uri() ) . 'js/magnific/magnific-popup.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'iconsult-custom-script', trailingslashit(get_template_directory_uri()) . 'js/theme.js', array( 'jquery' ), false, true );
	
	
	/*** Add dynamic value ***/ 
	
	if ( $iconsult_theme_options['theme-sticky-menu'] == false ){ $sticky_menu_status = 1; } else { $sticky_menu_status = 2; }
	// flip search text
	if( isset($iconsult_theme_options['global-flip-search-text-paceholder']) ){ 
		$replace_flip_search_txt = str_replace("'", "", $iconsult_theme_options['global-flip-search-text-paceholder']); 
	} else {
		$replace_flip_search_txt = '';
	}
	// faq
	$footer_js_faq_slug = get_query_var( 'term' );
	$footer_js_faq_current_term = get_term_by( 'slug', $footer_js_faq_slug, 'iconsultfaqcat' ); 
	if(  isset($footer_js_faq_current_term->taxonomy) == 'iconsultfaqcat'  ) { 
		$faq_js_handler = "var faq_search = location.href.split('#');if ( faq_search[1] != null ){var faq_search_id = faq_search[1];} else {var faq_search_id = '';}";
	} else {
		$faq_js_handler = "var faq_search_id = '';";
	}
	// add extra js code
	if(!empty($iconsult_theme_options['theme-add-extra-js-code'])){
		$extra_js_code = $iconsult_theme_options['theme-add-extra-js-code'];
	} else {
		$extra_js_code = '';
	}
	
	// wrap
	$js_tracking_code = '';
	 wp_add_inline_script( 'iconsult-custom-script', 'var go_up_icon = "'.esc_js($iconsult_theme_options['go_up_arrow_icon_style']).'";var sticky_menu = '.esc_js($sticky_menu_status).';var live_search_active = '.( ($iconsult_theme_options['global_live_search_status'] == false )?2:1).';var live_search_url ="'.home_url('/').'"; var filed_searchmsg = "'.esc_js($replace_flip_search_txt).'";'.sanitize_text_field($faq_js_handler).'  '.sanitize_text_field($extra_js_code).' '.sanitize_text_field($js_tracking_code) );
	/*** Eof add dynamic value ***/
	
	
	// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
	wp_enqueue_script('iconsult-requestcall', trailingslashit( get_template_directory_uri() ).'js/requestcall.js', array('jquery'), '1.0', true );
	wp_localize_script('iconsult-requestcall', 'iconsult__ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('iconsult-ajax-nonce')
	));
	
	/*
	* Adds JavaScript to pages with the comment form to support
	*/
	if ( is_singular() && comments_open() ) {  
			wp_enqueue_script( 'comment-reply' );
	}
		
	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'fontawesome', trailingslashit(get_template_directory_uri()) . 'css/font-awesome/css/fontawesome-all.css', array(), '3.3.1' );
	wp_enqueue_style( 'et-line-font', trailingslashit(get_template_directory_uri()) . 'css/et-line-font/style.css', array(), '3.3.1' );
	wp_enqueue_style( 'elegent-font', trailingslashit(get_template_directory_uri()) . 'css/elegent-font/style.css', array(), '3.3.1' );
	wp_enqueue_style( 'iconsult-style', get_stylesheet_uri(), array(), '1.0' );
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'iconsult-fonts', iconsult__fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap-min', trailingslashit(get_template_directory_uri()) . 'css/lib/bootstrap.min.css', array(), '3.3.1' );
	wp_enqueue_style( 'iconsult-flexslider-css', trailingslashit(get_template_directory_uri()) . 'css/flexslider/flexslider.css', array(), '2.5.0' );
	wp_enqueue_style( 'owlcarousel-style', trailingslashit( get_template_directory_uri() ) . 'js/owl/owl.carousel.css', array(), '' );
	wp_enqueue_style( 'iconsult-effect', trailingslashit(get_template_directory_uri()) . 'css/hover.css', array(), '' );
	wp_enqueue_style( 'iconsult-mediaelementplayer', trailingslashit(get_template_directory_uri()) . 'css/mediaelementplayer/mediaelementplayer.min.css', array(), '' );
	wp_enqueue_style( 'iconsult-lightbox', trailingslashit(get_template_directory_uri()) . 'css/lightbox/lightbox.css', array(), '' );
	
	 if ($woocommerce) {
		wp_enqueue_style("woocommerce", trailingslashit(get_template_directory_uri()) . "css/woocommerce.min.css");
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'iconsult__scripts' );


/*-----------------------------------------------------------------------------------*/
/*	ADMIN :: Enqueue scripts and styles.
/*-----------------------------------------------------------------------------------*/ 
function iconsult__admin_scripts() {
	 wp_enqueue_script( 'iconsult__admin_js', trailingslashit(get_template_directory_uri()) . 'js/admin/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'iconsult__admin_scripts' );


/*-----------------------------------------------------------------------------------*/
/*	iconsult__scripts() FOLLOW (FONT URL)
/*-----------------------------------------------------------------------------------*/ 
function iconsult__fonts_url() {
	global $iconsult_theme_options; 
	
	$fonts_url = $font_add = '';
	$fonts = $user_define_fonts = array();
	$subsets = 'latin,latin-ext';
	$subset = _x( 'no-subset', 'PT Sans font: add new subset (greek, cyrillic, vietnamese)', 'iconsult' );

	if ( 'cyrillic' == $subset )
		$subsets .= ',cyrillic,cyrillic-ext';
	elseif ( 'greek' == $subset )
		$subsets .= ',greek,greek-ext';
	elseif ( 'vietnamese' == $subset )
		$subsets .= ',vietnamese';
	
	// Google Dynamic Fonts
	$font_weight_str  = '100,200,300,400,500,600,700,800,900';
	$fonts_array = array('Montserrat:'.$font_weight_str, 'Rubik:'.$font_weight_str, 'Poppins:'.$font_weight_str);
	$user_define_fonts = array($iconsult_theme_options['theme-typography-body']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-h1-typography']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-h2-typography']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-h3-typography']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-h4-typography']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-h5-typography']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-h6-typography']['font-family'].':'.$font_weight_str, $iconsult_theme_options['theme-typography-nav']['font-family'].':'.$font_weight_str );
	$is_plugin_active = iconsult__plugin_active('ReduxFramework');
	if($is_plugin_active == false){
		$process_font_1 = array_unique($fonts_array);
	} else {
		$process_font_1 = array_unique(array_merge($fonts_array, $user_define_fonts));
	}
	$google_fonts_string = implode( '%7C', $process_font_1);
	
	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = add_query_arg(array(
						'family' =>  str_replace(' ', '+', $google_fonts_string),
						'subset' => $subsets,
					), '//fonts.googleapis.com/css');

	return $query_args;
}




/*-----------------------------------------------------------------------------------*/
/*	 Plugin Activation
/*-----------------------------------------------------------------------------------*/
require_once trailingslashit( get_template_directory() ) . 'framework/tgm/tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'iconsult__register_required_plugins' );
function iconsult__register_required_plugins() {
	$theme_url = trailingslashit( get_template_directory() );
	$plugins = array(
		// Contact Form 7
		array(
			'name'         => 'Contact Form 7', // The plugin name.
			'slug'         => 'contact-form-7', // The plugin slug (typically the folder name).
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		// VC
		array(
			'name'         => 'Visual Composer', // The plugin name.
			'slug'         => 'js_composer', // The plugin slug (typically the folder name).
			'source'       => $theme_url.'install/js_composer.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => $theme_url.'install/js_composer.zip', // If set, overrides default API URL and points to an external URL.
		),
		// Ultimate_VC_Addons
		array(
			'name'         => 'Ultimate Addons for WPBakery Page Builder', // The plugin name.
			'slug'         => 'Ultimate_VC_Addons', // The plugin slug (typically the folder name).
			'source'       => $theme_url.'install/Ultimate_VC_Addons.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => $theme_url.'install/Ultimate_VC_Addons.zip', // If set, overrides default API URL and points to an external URL.
		),
		// Slider R
		array(
			'name'         => 'Slider Revolution', // The plugin name.
			'slug'         => 'revslider', // The plugin slug (typically the folder name).
			'source'       => $theme_url.'install/revslider.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => $theme_url.'install/revslider.zip', // If set, overrides default API URL and points to an external URL.
		),
		// Iconsult Framework
		array(
			'name'         => 'Iconsult Framework', // The plugin name.
			'slug'         => 'iconsult-framework', // The plugin slug (typically the folder name).
			'source'       => $theme_url.'install/iconsult-framework.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => $theme_url.'install/iconsult-framework.zip', // If set, overrides default API URL and points to an external URL.
		),
		// Booked
		array(
			'name'         => 'Booked', // The plugin name.
			'slug'         => 'booked', // The plugin slug (typically the folder name).
			'source'       => $theme_url.'install/booked.zip', // The plugin source.
			'required'     => false, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => $theme_url.'install/booked.zip', // If set, overrides default API URL and points to an external URL.
		),
		// CMB2
		array(
			'name'         => 'CMB2', // The plugin name.
			'slug'         => 'cmb2', // The plugin slug (typically the folder name).
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		// Redux Framework
		array(
			'name'         => 'Redux Framework', // The plugin name.
			'slug'         => 'redux-framework', // The plugin slug (typically the folder name).
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		// WooCommerce
		array(
			'name'         => 'WooCommerce', // The plugin name.
			'slug'         => 'woocommerce', // The plugin slug (typically the folder name).
			'required'     => false, // If false, the plugin is only 'recommended' instead of required.
		),
		// bbPress
		array(
			'name'         => 'bbPress', // The plugin name.
			'slug'         => 'bbpress', // The plugin slug (typically the folder name).
			'required'     => false, // If false, the plugin is only 'recommended' instead of required.
		),
		// One Click Demo Import
		array(
			'name'         => 'One Click Demo Import', // The plugin name.
			'slug'         => 'one-click-demo-import', // The plugin slug (typically the folder name).
			'required'     => false, // If false, the plugin is only 'recommended' instead of required.
		),
		
	);
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}


/*-----------------------------------------------------------------------------------*/
/*	 Widget
/*-----------------------------------------------------------------------------------*/
function iconsult__widgets_init() {
	global $iconsult_theme_options;
	if( isset( $iconsult_theme_options['theme_footer_widget_title_tag'] ) && $iconsult_theme_options['theme_footer_widget_title_tag'] != '' ) {
		$footer_tag = $iconsult_theme_options['theme_footer_widget_title_tag'];	
	} else {
		$footer_tag = 'h6';
	}
	
	if( isset( $iconsult_theme_options['theme_global_widget_area_tag'] ) && $iconsult_theme_options['theme_global_widget_area_tag'] != '' ) {
		$global_widget_title_tag = $iconsult_theme_options['theme_global_widget_area_tag'];	
	} else {
		$global_widget_title_tag = 'h6';
	}
	// Sidebar - Blog
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'iconsult' ),
		'id'            => 'blog-widget-1',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$global_widget_title_tag.'>',
		'after_title'   => '</'.$global_widget_title_tag.'>',
	) );
	// Footer - 1
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Box 1', 'iconsult' ),
		'id'            => 'footer-box-1',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$footer_tag.'>',
		'after_title'   => '</'.$footer_tag.'>',
	) );
	// Footer - 2
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Box 2', 'iconsult' ),
		'id'            => 'footer-box-2',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$footer_tag.'>',
		'after_title'   => '</'.$footer_tag.'>',
	) );
	// Footer - 3
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Box 3', 'iconsult' ),
		'id'            => 'footer-box-3',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$footer_tag.'>',
		'after_title'   => '</'.$footer_tag.'>',
	) );
	// Footer - 4
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Box 4', 'iconsult' ),
		'id'            => 'footer-box-4',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$footer_tag.'>',
		'after_title'   => '</'.$footer_tag.'>',
	) );
	// Sidebar - KB
	register_sidebar( array(
		'name'          => esc_html__( 'KnowledgeBase Sidebar', 'iconsult' ),
		'id'            => 'kb-widget-1',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$global_widget_title_tag.'>',
		'after_title'   => '</'.$global_widget_title_tag.'>',
	) );
	// Sidebar - FAQ
	register_sidebar( array(
		'name'          => esc_html__( 'FAQ Sidebar', 'iconsult' ),
		'id'            => 'faq-widget-1',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$global_widget_title_tag.'>',
		'after_title'   => '</'.$global_widget_title_tag.'>',
	) );

	
	if(function_exists("is_woocommerce")){
		// Sidebar - Woo
		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce', 'iconsult' ),
			'id'            => 'woocommerce-widget-1',
			'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<'.$global_widget_title_tag.'>',
			'after_title'   => '</'.$global_widget_title_tag.'>',
		) );
		// Header - Woo Dropdown
		register_sidebar( array(
			'name'          => esc_html__( 'Header Nav - Woo Menu', 'iconsult' ),
			'id'            => 'woocommerce-widgetnav-1',
			'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<'.$global_widget_title_tag.'>',
			'after_title'   => '</'.$global_widget_title_tag.'>',
		) );

	}
	
	// Sidebar - bbPress
	register_sidebar( array(
		'name'          => esc_html__( 'bbPress', 'iconsult' ),
		'id'            => 'bbpress-widget-1',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<'.$global_widget_title_tag.'>',
		'after_title'   => '</'.$global_widget_title_tag.'>',
	) );
	
	// Header - Social Icon
	register_sidebar( array(
		'name'          => esc_html__( 'Header - Social Icon', 'iconsult' ),
		'id'            => 'header-social-widgetnav-1',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );
	
	// Header - Text with Icon Box
	register_sidebar( array(
		'name'          => esc_html__( 'Header - Icon With Text', 'iconsult' ),
		'id'            => 'header-icon-with-text-widget',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );
	
	// Header - Text with Icon Box
	register_sidebar( array(
		'name'          => esc_html__( 'Top Header - Icon With Text', 'iconsult' ),
		'id'            => 'header-top-icon-with-text-widget',
		'before_widget' => '<div id="%1$s" class="theme-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );
	
	
	
	
}
add_action( 'widgets_init', 'iconsult__widgets_init' );


/*-----------------------------------------------------------------------------------*/
/*	 Knowledge Base Additional Hook
/*-----------------------------------------------------------------------------------*/
add_filter('manage_edit-iconsult__kb_columns', 'iconsult__kb_additional_columns');
function iconsult__kb_additional_columns($columns) {
	$new_columns = array(
					'rating_yes' => esc_html__('Post Like', 'iconsult'),
					'rating_no' => esc_html__('Post Unlike', 'iconsult'),
					'visitors_stats' => esc_html__('Post Visitors', 'iconsult'),
				   );
    return array_merge($columns, $new_columns);
}

add_action('manage_iconsult__kb_posts_custom_column', 'iconsult__kb_show_additional_columns');
function iconsult__kb_show_additional_columns($name) {
		global $post;
		switch ($name) {
		case 'rating_yes':
			$yes = get_post_meta($post->ID, 'rating_like_count_post', true);
			if ($yes) {
				echo esc_attr($yes) .esc_html__(' like', 'iconsult');
			} else {
				echo esc_html__('--', 'iconsult');
			}
			break;
			
		 case 'rating_no':
		 	$no = get_post_meta($post->ID, 'rating_unlike_count_post', true);
			if ($no) {
				echo esc_attr($no) .esc_html__(' unlike', 'iconsult');
			} else {
				echo esc_html__('--', 'iconsult');
			}
			break;
			
		 case 'visitors_stats':
		 	echo get_post_meta($post->ID, 'display_post_impression', true);
			break;
			
		}
}


/*-----------------------------------------------------------------------------------*/
/*	Post Impression
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_nopriv_post-impression', 'iconsult__post_impression');
add_action('wp_ajax_post-impression', 'iconsult__post_impression');
function iconsult__post_impression()
{  
	// Check for nonce security
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'iconsult-ajax-nonce' ) )
        die ( 'Busted!');
		
	 if(isset($_POST['post_id'])) {
		$post_id = $_POST['post_id'];
		$meta_visitors = get_post_meta($post_id, "display_post_impression", true);
		update_post_meta($post_id, "display_post_impression", ++$meta_visitors);
	}
	
	 exit;
}


/*-----------------------------------------------------------------------------------*/
/*	Woo Hook
/*-----------------------------------------------------------------------------------*/

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_add_to_cart_header');
function woocommerce_add_to_cart_header( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<span class="header_cart_span"><?php echo esc_attr($woocommerce->cart->cart_contents_count); ?></span>
	<?php
		$fragments['span.header_cart_span'] = ob_get_clean();
		return $fragments;	
}



/*-----------------------------------------------------------------------------------*/
/*	Voting Ajax Call
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_nopriv_post-like', 'iconsult__voting_postlike');
add_action('wp_ajax_post-like', 'iconsult__voting_postlike');
add_action('wp_ajax_nopriv_post-unlike', 'iconsult__voting_postunlike');
add_action('wp_ajax_post-unlike', 'iconsult__voting_postunlike');
add_action('wp_ajax_nopriv_post-reset-stats', 'iconsult__stats_reset');
add_action('wp_ajax_post-reset-stats', 'iconsult__stats_reset');


function iconsult__stats_reset() {
	
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'iconsult-ajax-nonce' ) )
        die ( 'Busted!');
		
    if(isset($_POST['post_reset'])) { 
		$post_id = $_POST['post_id'];  
		update_post_meta($post_id, "voted_IP", '');
		update_post_meta($post_id, "rating_like_count_post", '');
		update_post_meta($post_id, "rating_unlike_count_post", '');
		update_post_meta($post_id, "display_post_impression", '');
	}
	exit;
}

function iconsult__voting_postlike() {
	global $iconsult_theme_options;
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'iconsult-ajax-nonce' ) )
        die ( 'Busted!');
	
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = getenv('REMOTE_ADDR');
        $post_id = $_POST['post_id'];
        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
		if (!empty($meta_IP)) {
			$voted_IP = $meta_IP[0];
		} else {
			$voted_IP = '';
		}
 
        if(!is_array($voted_IP))
            $voted_IP = array();
			// Get votes count for the current post
			$meta_count = get_post_meta($post_id, "rating_like_count_post", true);
 
        // User has already voted ?
        if(!iconsult__hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();
            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "rating_like_count_post", ++$meta_count);
            // Display count (ie jQuery return value)
            echo esc_attr($meta_count);
        } else {
             echo esc_attr($iconsult_theme_options['already-voted-message']);
		}
    }
    exit;
	
}


function iconsult__voting_postunlike()
{
	global $iconsult_theme_options;
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'iconsult-ajax-nonce' ) )
        die ( 'Busted!');
		
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = getenv('REMOTE_ADDR');
        $post_id = $_POST['post_id'];
        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
		if (!empty($meta_IP)) {
			$voted_IP = $meta_IP[0];
		} else {
			$voted_IP = '';
		}
 
        if(!is_array($voted_IP))
            $voted_IP = array();
			// Get votes count for the current post
			$meta_count = get_post_meta($post_id, "rating_unlike_count_post", true);
 
        // Use has already voted ?
        if(!iconsult__hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();
            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "rating_unlike_count_post", ++$meta_count);
            // Display count (ie jQuery return value)
            echo esc_attr($meta_count);
        }
        else {
            echo esc_attr($iconsult_theme_options['already-voted-message']);
		}
    }
    exit;
}



$timebeforerevote = 30; // = 30 mins
function iconsult__hasAlreadyVoted($post_id)
{
    global $timebeforerevote;
 
    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
	if (!empty($meta_IP)) {
		$voted_IP = $meta_IP[0];
	} else {
		$voted_IP = '';
	}
     
    if(!is_array($voted_IP))
        $voted_IP = array();
         
    // Retrieve current user IP
    $ip = getenv('REMOTE_ADDR');
     
    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();
         
        // Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;
             
        return true;
    }
     
    return false;
}


/*-----------------------------------------------------------------------------------*/
/*	FAQ SINGLE PG REDIRECT
/*-----------------------------------------------------------------------------------*/ 
function iconsult__faq_post_red() {
  global $post;
  $queried_post_type = get_query_var('post_type');
  $term_slug = get_query_var( 'term' );
  
  // Faq
  $current_term_faq = get_term_by( 'slug', $term_slug, 'iconsultfaqcat' );
  if ( is_single() && 'iconsult_faq' ==  $queried_post_type ) {
     // current post ID
	 $postID = get_the_ID();
	 // Post category ID
	 $terms = get_the_terms( $postID , 'iconsultfaqcat' );
	 if( !empty($terms) ) { 
		 $term = array_pop($terms);
		 $catID = $term->term_taxonomy_id;
		 $category_link = esc_url( get_category_link( $catID ) ).'#'.$postID;
		 wp_redirect( $category_link, 301 );
		 exit;
	 } else {
		 esc_html_e( 'Please assign category for your FAQ RECORD', 'iconsult' );
		 exit;
	 }
  } else if(  isset($current_term_faq->taxonomy) == 'iconsultfaqcat'  ) {
	 setcookie("iconsultFaqSingleID", '', time() - 3600, '/'); 
  }
}
add_action( 'template_redirect', 'iconsult__faq_post_red' );


/*-----------------------------------------------------------------------------------*/
/*	pingback url auto-discovery header
/*-----------------------------------------------------------------------------------*/ 
function iconsult__pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'iconsult__pingback_header' );


/*-----------------------------------------------------------------------------------*/
/*	Remove Links from Admin Bar
/*-----------------------------------------------------------------------------------*/
function iconsult__remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('iconsult');
}
add_action( 'wp_before_admin_bar_render', 'iconsult__remove_admin_bar_links' );


/*-----------------------------------------------------------------------------------*/
/*	ReduxFrameworkPlugin MODIFY
/*-----------------------------------------------------------------------------------*/ 
function iconsult__admin_custom_style() {
  wp_enqueue_style('iconsult-admin-styles', trailingslashit(get_template_directory_uri()) . 'css/admin.css', array(), '' );
}
add_action('admin_enqueue_scripts', 'iconsult__admin_custom_style');

/** REMOVE REDUX MESSAGES */
function iconsult__remove_redux_messages() {
	if(class_exists('ReduxFramework')){
		remove_action( 'admin_notices', array( get_redux_instance('_iconsult_theme_options_'), '_admin_notices' ), 99);
	}
}
add_action('init', 'iconsult__remove_redux_messages');
?>