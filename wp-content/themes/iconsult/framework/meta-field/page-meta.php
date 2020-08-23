<?php
/*-----------------------------------------------------------------------------------*/
/*	 POST :: FORMAT OPTIONS
/*-----------------------------------------------------------------------------------*/

/*** QUOTE POST FORMAT ***/
add_action( 'cmb2_admin_init', 'iconsult__post_format_quote' );
function iconsult__post_format_quote() {

    $prefix = '__iconsult_';

    $cmb = new_cmb2_box( array(
        'id'            => 'blog_admin_post_format_quote',
        'title'         => esc_html__( 'Quote Post Format', 'iconsult' ),
        'object_types'  => array( 'post', ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );
	
	$cmb->add_field( array(
	    'name'    => esc_html__( 'Quote', 'iconsult' ),
		'id'      => $prefix.'post_format_quote',
		'type'    => 'text',
	) );
	
}

/*** AUDIO POST FORMAT ***/
add_action( 'cmb2_admin_init', 'iconsult__post_format_audio' );
function iconsult__post_format_audio() {

    $prefix = '__iconsult_';

    $cmb = new_cmb2_box( array(
        'id'            => 'blog_admin_post_format_audio',
        'title'         => esc_html__( 'Audio Post Format', 'iconsult' ),
        'object_types'  => array( 'post', ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );
	
	$cmb->add_field( array(
	    'name'    => esc_html__( 'Audio Link ', 'iconsult' ),
		'id'      => $prefix.'post_format_audio',
		'type'    => 'text',
	) );
	
}

/*** LINK POST FORMAT ***/
add_action( 'cmb2_admin_init', 'iconsult__post_format_link' );
function iconsult__post_format_link() {

    $prefix = '__iconsult_';

    $cmb = new_cmb2_box( array(
        'id'            => 'blog_admin_post_format_link',
        'title'         => esc_html__( 'Link Post Format', 'iconsult' ),
        'object_types'  => array( 'post', ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );
	
	$cmb->add_field( array(
	    'name'    => esc_html__( 'Link ', 'iconsult' ),
		'id'      => $prefix.'post_format_link',
		'type'    => 'text',
	) );
	
}


/*-----------------------------------------------------------------------------------*/
/*	 PAGE :: Navigation Menu Control
/*-----------------------------------------------------------------------------------*/
add_action( 'cmb2_admin_init', 'iconsult__page_navigation_menu_control' );
function iconsult__page_navigation_menu_control() {
    $prefix = '__iconsult_';
    $cmb = new_cmb2_box( array(
        'id'            => 'page_navigation_section_control',
        'title'         => esc_html__( 'Navigation Style Controls', 'iconsult' ),
        'object_types'  => array( 'page', 'post', 'iconsult_portfolio', 'iconsult_kb', 'iconsult_services' ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
		'closed'     => false,
    ) );
	
	// fields start
	$cmb->add_field( array(
    'name'             => esc_html__( 'Nav Bar Style', 'iconsult' ),
    'desc'             => 'Select an option',
    'id'               => $prefix .'header_menu_bar_type',
    'type'             => 'select',
    //'show_option_none' => true,
    'default'          => 'standard',
	'desc'             => 'To enable "Transparent Background" <strong>one of 4 available options below must be active;</strong>
						  <br> 1. If choose, "Page Header Background Color" OR
						  <br> 2. If upload, "Page Header Image" OR 
						  <br> 3. If enter, "Slider Revolution ShortCode"  OR 
						  <br> 4. If activate, "Header Slider". <br><br>
						  Please use "Page Header Configuration" below to configure one of 4 available option above.
						  ',
    'options'          => array(
        'standard' => esc_html__( 'Without Background (White Backgorund)', 'iconsult' ),
        'custom'   => esc_html__( 'With Transparent Background', 'iconsult' ),
		),
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Hide Navigation Area Initially', 'iconsult' ),
		'desc' => esc_html__( 'Enabling this option will initially hide the header, and it will only display when the user scrolls down the page. (NOTE: Sticky Menu, must be enable to display menu)', 'iconsult' ),
		'id'   => $prefix .'header_nav_hide_initally',
		'type' => 'checkbox'
	) );
	
    $cmb->add_field( array(
		'name' => esc_html__( 'Add Nav Background', 'iconsult' ),
		'desc' => 'If checked, transparent background will be added on header nav bar.',
		'id'   => $prefix .'header_nav_bar_bg_color_status',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
		'name'    => esc_html__( 'Nav Background Color', 'iconsult' ),
		'id'      => $prefix .'nav_bar_bg_color',
		'type'    => 'colorpicker',
		'default' => '#35373F',
		'classes' => 'theme_metabox_margin_left_50',
	) );
	
	$cmb->add_field( array(
		'name'    => esc_html__( 'Nav Background Color Opacity', 'iconsult' ),
		'default' => '',
		'id'      => $prefix .'nav_bar_bg_color_opacity',
		'type'    => 'text_small',
		'desc' => 'Default:0.3 (Make sure opacity value is between 0.1 to 0.9)',
		'classes' => 'theme_metabox_margin_left_50',
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Add Nav Border Bottom', 'iconsult' ),
		'desc' => esc_html__( 'If checked, transparent border will be added on header nav bar (works best with header type "Transparent Background")', 'iconsult' ),
		'id'   => $prefix .'header_nav_transparent_border_status',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
		'name'    => esc_html__( 'Nav Border Bottom Color', 'iconsult' ),
		'id'      => $prefix .'nav_border_color',
		'type'    => 'colorpicker',
		'default' => '#949494',
		'classes' => 'theme_metabox_margin_left_50',
	) );
	
	$cmb->add_field( array(
		'name'    => esc_html__( 'Nav Border Bottom Color Opacity', 'iconsult' ),
		'default' => '',
		'id'      => $prefix .'nav_border_opacity',
		'type'    => 'text_small',
		'desc' => 'Default:0.12 (Make sure opacity value is between 0.1 to 0.9)',
		'classes' => 'theme_metabox_margin_left_50',
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Add Nav Box Shadow', 'iconsult' ),
		'desc' => 'If checked, Box Shadow will be added on the header nav bar <strong style="color:#e6614b;">replacing Nav Border Bottom</strong>.',
		'id'   => $prefix .'add_nav_box_shadow',
		'type' => 'checkbox'
	) );
	// eof fields
}	
	


/*-----------------------------------------------------------------------------------*/
/*	 PAGE - POST :: OPTIONS
/*-----------------------------------------------------------------------------------*/

add_action( 'cmb2_admin_init', 'iconsult__page_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function iconsult__page_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '__iconsult_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'page_options',
        'title'         => esc_html__( 'Page Header Configuration', 'iconsult' ),
        'object_types'  => array( 'page', 'post', 'iconsult_portfolio', 'iconsult_kb', 'iconsult_services' ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
		'closed'     => true,
    ) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Activate Top Header', 'iconsult' ),
		'desc' => 'If checked, top header will activate replacing theme option settings <strong style="color:#e6614b;">Only, work for page</strong>',
		'id'   => $prefix .'top_header_activate_status',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Hide Header Bar', 'iconsult' ),
		'desc' => 'Check to hide header bar that appear right after logo & menu bar.',
		'id'   => $prefix .'header_hide_header_bar',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
    'name'    => esc_html__( 'Re-adjust Header Height/Padding', 'iconsult' ), 
    'desc'    => 'Default: 26px 15px 20px 15px (TOP, RIGHT, BOTTOM, LEFT) <br> <strong style="color:#e6614b;">IMPORTANT: Make sure value of RIGHT, LEFT are always 15px</strong>', 
    'default' => '26px 15px 20px 15px',
    'id'      => $prefix.'readjust_padding_height',
    'type'    => 'text'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Page Header Background Color', 'iconsult' ),
		'desc' => 'Background color <strong>will NOT work</strong> if checked option <strong>\'Apply Parallax Effect For the Upload Image\'</strong> ',
		'id'   => $prefix .'header_background_color',
		'type' => 'colorpicker'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Page Header Background Linear Gradient Color', 'iconsult' ),
		'id'   => $prefix .'header_linear_background_color',
		'desc' => '<strong style="color:#e6614b;">NOTE: Page Header Background Color must be enable to activate this feature.</strong>',
		'type' => 'colorpicker',
		'classes' => 'theme_metabox_margin_left_50',
	) );

	
	$cmb->add_field( array(
		'name'    => esc_html__( 'Page Header Image', 'iconsult' ), 
		'desc'    => esc_html__( 'Upload image for your header (Note: Does not work if, place slider revolution shortcode or checked iconsult slider) ' , 'iconsult' ),
		'id'      => $prefix .'header_background_image',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => true, 
			'add_upload_file_text' => 'Add Or Upload File' 
		),
	) );
	
	$cmb->add_field( array(
		'name'             => esc_html__( 'Background Image Display Position', 'iconsult' ),
		'desc'             => 'Select an option',
		'id'               => $prefix .'background_img_display_position',
		'type'             => 'select',
		//'show_option_none' => true,
		'default'          => 'center center',
		'options'          => array(
			'center top'      => esc_html__( 'Center Top', 'iconsult' ),
			'center center'   => esc_html__( 'Center Center', 'iconsult' ),
			'center bottom'   => esc_html__( 'Center Bottom', 'iconsult' ),
			),
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Apply Parallax Effect For the Upload Image', 'iconsult' ),
		'desc' => esc_html__( 'If checked, Parallax effect will activate', 'iconsult' ),
		'id'   => $prefix .'header_parallax_status',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Remove Opacity (Transparency) For the Upload Image', 'iconsult' ),
		'desc' => esc_html__( 'If checked, background opacity Will be removed', 'iconsult' ),
		'id'   => $prefix .'header_image_opacity_status',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Background Opacity Color For the Upload Image', 'iconsult' ),
		'desc' => esc_html__( 'Replace default opacity color', 'iconsult' ),
		'id'   => $prefix .'header_bg_image_opacity_color',
		'type' => 'colorpicker',
		'classes' => 'theme_metabox_margin_left_50'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Background Color Opacity Depth', 'iconsult' ),
		'id'   => $prefix .'header_bg_image_opacity_color_depth',
		'desc' => '(Default: 0.3) Make sure opacity value is between 0.1 to 0.9',
		'type' => 'text_small',
		'classes' => 'theme_metabox_margin_left_50',
	) );
	
	$cmb->add_field( array(
		'name'    => esc_html__( 'Slider Revolution ShortCode', 'iconsult' ),
		'desc'    => 'Will replace header image or background color (Copy and paste your shortcode located in "Slider Revolution -> Slider Revolution -> Embed Slider")',
		'id'      => $prefix .'slider_revolution_shortcode',
		'type'    => 'text',
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Activate Search Box', 'iconsult' ),
		'desc' => esc_html__( 'If checked, iconsult ajax search box will appear on the header', 'iconsult' ),
		'id'   => $prefix .'header_searchbox_status',
		'type' => 'checkbox'
	) );
}


add_action( 'cmb2_admin_init', 'iconsult__page_replacement_metaboxes' );
function iconsult__page_replacement_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '__iconsult_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'page_replacement_options',
        'title'         => esc_html__( 'Header Text Settings', 'iconsult' ),
        'object_types'  => array( 'page', 'post', 'iconsult_portfolio', 'iconsult_kb', 'iconsult_services' ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
		'closed'     => true,
    ) );
	
	$cmb->add_field( array(
    'name'             => esc_html__( 'Text Alignment', 'iconsult' ),
    'desc'             => esc_html__( 'Specify Title, Subtitle text alignment', 'iconsult' ),
    'id'               => $prefix .'header_text_alignment_tye',
    'type'             => 'select',
    'default'          => 'left',
    'options'          => array(
        'left'    => esc_html__( 'Left', 'iconsult' ),
		'center'  => esc_html__( 'Center', 'iconsult' ),
        'right'   => esc_html__( 'Right', 'iconsult' ),
		),
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Disable Main/Replacement Title', 'iconsult' ),
		'desc' => esc_html__( 'If checked, title will be disable', 'iconsult' ),
		'id'   => $prefix .'header_disable_main_replacement_title',
		'type' => 'checkbox'
	) );
	
	$cmb->add_field( array(
    'name'    => esc_html__( 'Replacement Title', 'iconsult' ),
    'desc'    => esc_html__( 'New page tagline', 'iconsult' ), 
    'id'      => $prefix.'replacement_title',
    'type'    => 'text',
	) );

	$group_field_title_text_other_settings = $cmb->add_field( array(
    'id'          => $prefix.'title_text_settings',
    'type'        => 'group',
    'repeatable'  => false,
    'options'     => array(
        'group_title'   => esc_html__( '[+] Replacement Title Text Style', 'iconsult' ), 
        'add_button'    => esc_html__( 'Add Another Entry', 'iconsult' ),
        'remove_button' => esc_html__( 'Remove Entry', 'iconsult' ),
        'sortable'      => true, 
        'closed'       => true, 
    ),
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'    => esc_html__( 'Text Color', 'iconsult' ),  
    'id'      => 'title_text_color',
    'type'    => 'colorpicker',
	'desc'    => '<strong>Default: #4d515c</strong>  (NOTE: for image background use #FFFFFF)',
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'    => esc_html__( 'Text Size', 'iconsult' ),
    'desc'    => '<strong>Default:19px</strong> (please enter as: 19px)',
    'default' => '19px',
    'id'      => 'title_text_size',
    'type'    => 'text_small'
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'             => esc_html__( 'Title Weight', 'iconsult' ),
    'id'               => 'title_text_weight',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => '600',
	'desc'    => '<strong>Default: Semi-Bold 600</strong>',
    'options'          => array(
        '100' => esc_html__( 'Thin 100', 'iconsult' ),
        '200'   => esc_html__( 'Extra-Light 200', 'iconsult' ),
        '300'     => esc_html__( 'Light 300', 'iconsult' ),
        '400'     => esc_html__( 'Regular 400', 'iconsult' ),
        '500'     => esc_html__( 'Medium 500', 'iconsult' ),
        '600'     => esc_html__( 'Semi-Bold 600', 'iconsult' ),
        '700'     => esc_html__( 'Bold 700', 'iconsult' ),
        '800'     => esc_html__( 'Extra-Bold 800', 'iconsult' ),
        '900'     => esc_html__( 'Ultra-Bold 900', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'             => esc_html__( 'Font Family', 'iconsult' ),
    'id'               => 'title_text_font_family',
    'type'             => 'select',
    'show_option_none' => true,
    'options'          => array(
		'Poppins' => esc_html__( 'Poppins', 'iconsult' ),
		'Montserrat' => esc_html__( 'Montserrat', 'iconsult' ),
    ),
	) );

	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'             => esc_html__( 'Title Text Transform', 'iconsult' ),
    'id'               => 'title_text_transform',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => 'none',
    'options'          => array(
        'uppercase' => esc_html__( 'Uppercase', 'iconsult' ),
        'capitalize'   => esc_html__( 'Capitalize', 'iconsult' ),
        'none'     => esc_html__( 'None', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'    => esc_html__( 'Letter Spacing', 'iconsult' ),
    'desc'    => '<strong>Example: -1.2px, 2px ... etc</strong> ',
    'default' => '',
    'id'      => 'title_text_letterspecing',
    'type'    => 'text_small'
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'    => esc_html__( 'Padding', 'iconsult' ),
    'desc'    => '<strong>Default: 0px 0px 0px 0px (top, right, buttom, left)</strong> ',
    'default' => '',
    'id'      => 'title_text_padding',
    'type'    => 'text'
	) );
	
	$cmb->add_group_field( $group_field_title_text_other_settings, array(
    'name'    => esc_html__( 'Line Height', 'iconsult' ),
    'desc'    => 'example:35px',
    'default' => '',
    'id'      => 'title_text_line_height',
    'type'    => 'text'
	) );
	
	
	$cmb->add_field( array(
    'name'    => esc_html__( 'Subtitle Text', 'iconsult' ),
    'desc'    => esc_html__( 'Enter your subtitle text (will appear under title)', 'iconsult' ), 
    'id'      => $prefix.'desc_under_title',
    'type'    => 'text',
	) );
	
	$group_field_subtitle_text_other_settings = $cmb->add_field( array(
    'id'          => $prefix.'subtitle_text_settings',
    'type'        => 'group',
    'repeatable'  => false,
    'options'     => array(
        'group_title'   => esc_html__( '[+] Subtitle Text Style', 'iconsult' ), 
        'add_button'    => esc_html__( 'Add Another Entry', 'iconsult' ),
        'remove_button' => esc_html__( 'Remove Entry', 'iconsult' ),
        'sortable'      => true, 
        'closed'       => true, 
    ),
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'    => esc_html__( 'Text Color', 'iconsult' ),  
    'id'      => 'title_text_color',
    'type'    => 'colorpicker',
	'desc'    => 'NOTE: for image background use #FFFFFF',
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'    => esc_html__( 'Text Size', 'iconsult' ),
    'default' => '14px',
    'id'      => 'title_text_size',
    'type'    => 'text_small'
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'             => esc_html__( 'Title Weight', 'iconsult' ),
    'id'               => 'title_text_weight',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => '400',
    'options'          => array(
        '100' => esc_html__( 'Thin 100', 'iconsult' ),
        '200'   => esc_html__( 'Extra-Light 200', 'iconsult' ),
        '300'     => esc_html__( 'Light 300', 'iconsult' ),
        '400'     => esc_html__( 'Regular 400', 'iconsult' ),
        '500'     => esc_html__( 'Medium 500', 'iconsult' ),
        '600'     => esc_html__( 'Semi-Bold 600', 'iconsult' ),
        '700'     => esc_html__( 'Bold 700', 'iconsult' ),
        '800'     => esc_html__( 'Extra-Bold 800', 'iconsult' ),
        '900'     => esc_html__( 'Ultra-Bold 900', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'             => esc_html__( 'Font Family', 'iconsult' ),
    'id'               => 'subtitle_font_family',
    'type'             => 'select',
    'show_option_none' => true,
    'options'          => array(
		'Poppins' => esc_html__( 'Poppins', 'iconsult' ),
		'Montserrat' => esc_html__( 'Montserrat', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'             => esc_html__( 'Text Transform', 'iconsult' ),
    'id'               => 'subtitle_text_transform',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => 'none',
	'desc'    => '<strong>Default: none</strong>',
    'options'          => array(
        'uppercase' => esc_html__( 'Uppercase', 'iconsult' ),
        'capitalize'   => esc_html__( 'Capitalize', 'iconsult' ),
        'none'     => esc_html__( 'None', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'    => esc_html__( 'Letter Spacing', 'iconsult' ),
    'desc'    => '<strong>Example: -1.2px, 2px ... etc</strong> ',
    'default' => '',
    'id'      => 'sub_title_text_letterspecing',
    'type'    => 'text_small'
	) );
	
	$cmb->add_group_field( $group_field_subtitle_text_other_settings, array(
    'name'    => esc_html__( 'Padding', 'iconsult' ),
    'desc'    => '<strong>Default: 0px 0px 0px 0px (top right buttom left)</strong> ',
    'default' => '',
    'id'      => 'sub_title_text_padding',
    'type'    => 'text'
	) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Disable Breadcrumb', 'iconsult' ),
		'desc' => esc_html__( 'If checked, breadcrumb will be disable', 'iconsult' ),
		'id'   => $prefix .'header_breadcrumb_status',
		'type' => 'checkbox'
	) );
	
	$group_breadcrumb_other_settings = $cmb->add_field( array(
    'id'          => $prefix.'breadcrumb_settings',
    'type'        => 'group',
    'repeatable'  => false,
    'options'     => array(
        'group_title'   => esc_html__( '[+] Breadcrumb Style', 'iconsult' ), 
        'add_button'    => esc_html__( 'Add Another Entry', 'iconsult' ),
        'remove_button' => esc_html__( 'Remove Entry', 'iconsult' ),
        'sortable'      => true, 
        'closed'       => true, 
    ),
	) );
	
	$cmb->add_group_field( $group_breadcrumb_other_settings, array(
    'name'    => esc_html__( 'Text Color', 'iconsult' ),  
    'id'      => 'text_color',
    'type'    => 'colorpicker',
	'desc'    => 'NOTE: for image background use #F4F4F4',
	) );

	$cmb->add_group_field( $group_breadcrumb_other_settings, array(
    'name'    => esc_html__( 'Link Text Color', 'iconsult' ),  
    'id'      => 'link_text_color',
    'type'    => 'colorpicker',
	'desc'    => 'NOTE: for image background use #FFFFFF',
	) );

	$cmb->add_group_field( $group_breadcrumb_other_settings, array(
    'name'    => esc_html__( 'Link Text Hover Color', 'iconsult' ),  
    'id'      => 'link_text_hover_color',
    'type'    => 'colorpicker',
	) );
	
	$cmb->add_group_field( $group_breadcrumb_other_settings, array(
    'name'    => esc_html__( 'Breadcrumb Speration/Arrow color', 'iconsult' ),  
    'id'      => 'link_arrow_color',
    'type'    => 'colorpicker',
	) );
	
}





/*-----------------------------------------------------------------------------------*/
/*	 PAGE :: iconsult SLIDER
/*-----------------------------------------------------------------------------------*/

add_action( 'cmb2_admin_init', 'iconsult__page_metaboxes_bindslider' );
/**
 * Define the metabox and field configurations.
 */
function iconsult__page_metaboxes_bindslider() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '__iconsult_';
	
	 /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'page_bind_slider_options',
        'title'         => esc_html__( 'Iconsult Slider (Header Slider)', 'iconsult' ),
        'object_types'  => array( 'page', ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
		'closed'     => true,
    ) );
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Activate iconsult Slider', 'iconsult' ),
		'desc' => 'If checked, iconsult slider will activate <strong>replacing slider revolution shortcode or background image or background color</strong>',
		'id'   => $prefix.'slider_active_status',
		'type' => 'checkbox'
	) );

	$cmb->add_field( array(
		'name'    => esc_html__( 'iconsult Slider Height', 'iconsult' ), 
		'desc'    => '<strong>(Default: 520px)</strong> Re-adjust slider height',
		'default' => '520px',
		'id'      => $prefix.'slider_height',
		'type'    => 'text',
	) );
	
	$bind_slider_group_field_id = $cmb->add_field( array(
		'id'          => $prefix.'header_flex_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'iconsult Slider {#}', 'iconsult' ), 
			'add_button'    => esc_html__( 'Add Another Entry', 'iconsult' ),
			'remove_button' => esc_html__( 'Remove Entry', 'iconsult' ),
			'sortable'      => true, // beta
			'closed'        => true, // true to have the groups closed by default
		),
	) );

	$cmb->add_group_field( $bind_slider_group_field_id, array(
		'name' => esc_html__( 'Upload Image', 'iconsult' ), 
		'id'   => 'image',
		'type' => 'file',
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
		'name' => esc_html__( 'Apply Opacity (Transparency) For the Upload Image', 'iconsult' ), 
		'id'   => 'image_opacity',
		'type' => 'checkbox',
		'desc' => esc_html__( 'If checked, background opacity will be added', 'iconsult' ),
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'             => esc_html__( 'Background Image Display Position', 'iconsult' ),
    'id'               => 'slider_img_display_position',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => 'center center',
    'options'          => array(
        'center top'      => esc_html__( 'Center Top', 'iconsult' ),
		'center center'   => esc_html__( 'Center Center', 'iconsult' ),
		'center bottom'   => esc_html__( 'Center Bottom', 'iconsult' ),
    ),
	) );

	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name' => esc_html__( 'Title', 'iconsult' ),
    'id'   => 'flex-title',
    'type' => 'text',
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
	'name'    => esc_html__( 'Title Font Size', 'iconsult' ),
	'desc'    => esc_html__( 'Default: 52px', 'iconsult' ),
	'default' => '52px',
	'id'      => 'bind_slider_title_size',
	'type'    => 'text_small'
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'             => esc_html__( 'Title Weight', 'iconsult' ),
    'desc'             => esc_html__( '((Default: 900)) redefine weight of the title', 'iconsult' ), 
    'id'               => 'redefine_title_weight',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => '900',
    'options'          => array(
        '100' => esc_html__( 'Thin 100', 'iconsult' ),
        '200'   => esc_html__( 'Extra-Light 200', 'iconsult' ),
        '300'     => esc_html__( 'Light 300', 'iconsult' ),
        '400'     => esc_html__( 'Regular 400', 'iconsult' ),
        '500'     => esc_html__( 'Medium 500', 'iconsult' ),
        '600'     => esc_html__( 'Semi-Bold 600', 'iconsult' ),
        '700'     => esc_html__( 'Bold 700', 'iconsult' ),
        '800'     => esc_html__( 'Extra-Bold 800', 'iconsult' ),
        '900'     => esc_html__( 'Ultra-Bold 900', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'             => esc_html__( 'Title Font Family', 'iconsult' ),
    'id'               => 'redefine_title_font',
    'type'             => 'select',
    'show_option_none' => true,
    'options'          => array(
        'Raleway' => esc_html__( 'Raleway', 'iconsult' ),
		'Open Sans' => esc_html__( 'Open Sans', 'iconsult' ),
		'Lato' => esc_html__( 'Lato', 'iconsult' ),
		'Roboto' => esc_html__( 'Roboto', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name' => esc_html__( 'Title Margin Top', 'iconsult' ),
    'id'   => 'flex-title-margin-top',
    'type' => 'text_small',
	'desc'    => '<strong>Default:</strong> 50px',
	'default' => '50px',
	) );
	
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name' => esc_html__( 'Sub Title', 'iconsult' ),
    'id'   => 'flex-sub-title',
    'type' => 'text',
	) );

	$cmb->add_group_field( $bind_slider_group_field_id, array(
	'name'    => esc_html__( 'Sub Title Font Size', 'iconsult' ),
	'desc'    => esc_html__( 'Default: 22px', 'iconsult' ),
	'default' => '22px',
	'id'      => 'bind_slider_sub_title_size',
	'type'    => 'text_small'
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'             => esc_html__( 'Sub Title Weight', 'iconsult' ),
    'desc'             => esc_html__( '(Default: 300) redefine weight of the title', 'iconsult' ), 
    'id'               => 'redefine_sub_title_weight',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => '300',
    'options'          => array(
        '100' => esc_html__( 'Thin 100', 'iconsult' ),
        '200'   => esc_html__( 'Extra-Light 200', 'iconsult' ),
        '300'     => esc_html__( 'Light 300', 'iconsult' ),
        '400'     => esc_html__( 'Regular 400', 'iconsult' ),
        '500'     => esc_html__( 'Medium 500', 'iconsult' ),
        '600'     => esc_html__( 'Semi-Bold 600', 'iconsult' ),
        '700'     => esc_html__( 'Bold 700', 'iconsult' ),
        '800'     => esc_html__( 'Extra-Bold 800', 'iconsult' ),
        '900'     => esc_html__( 'Ultra-Bold 900', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'             => esc_html__( 'Sub Title Font Family', 'iconsult' ),
    'id'               => 'redefine_sub_title_font',
    'type'             => 'select',
    'show_option_none' => true,
    'options'          => array(
        'Raleway' => esc_html__( 'Raleway', 'iconsult' ),
		'Open Sans' => esc_html__( 'Open Sans', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name' => esc_html__( 'Message Box Padding', 'iconsult' ),
    'id'   => 'flex-message-box-padding',
    'type' => 'text',
	'desc'    => '<strong>Format:</strong> (14% 10% 0px 10%) == (top right bottom left) <br>WARNING:: Make sure to keep space',
	'default' => '14% 10% 0px 10%',
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'             => esc_html__( 'Message Box Text Align', 'iconsult' ),
    'desc'             => esc_html__( 'redefine text alignment', 'iconsult' ), 
    'id'               => 'redefine_message_box_alignment',
    'type'             => 'select',
    'show_option_none' => false,
    'default'          => 'center',
    'options'          => array(
        'left'    => esc_html__( 'Left', 'iconsult' ),
        'center'  => esc_html__( 'Center', 'iconsult' ),
        'right'   => esc_html__( 'Right', 'iconsult' ),
    ),
	) );
	
	$cmb->add_group_field( $bind_slider_group_field_id, array(
    'name'    => esc_html__( 'Text Color', 'iconsult' ),
    'id'      => 'bind_slider_color',
    'type'    => 'colorpicker',
    'default' => '#ffffff',
	'desc'    => esc_html__( '(Default: #FFFFFF)', 'iconsult' ), 
	) );
	
}


/*-----------------------------------------------------------------------------------*/
/*	 PAGE :: SIDEBAR OPTIONS
/*-----------------------------------------------------------------------------------*/

add_action( 'cmb2_admin_init', 'iconsult__page_format_sidebar' );
function iconsult__page_format_sidebar() {

    $prefix = '__iconsult_';

    $cmb = new_cmb2_box( array(
        'id'            => 'page_admin_sidebar',
        'title'         => esc_html__( 'Page Sidebar', 'iconsult' ),
        'object_types'  => array( 'page', ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
		'closed'     => true,
    ) );
	
	$cmb->add_field( array(
		'name'             => esc_html__( 'Sidebar Layout', 'iconsult' ),
		'desc'             => 'Choose the sidebar layout <strong>(Only work for the page template: "default")</strong>',
		'id'               => $prefix .'page_sidebar_layout_status',
		'type'             => 'select',
		'show_option_none' => true,
		'default'          => '',
		'options'          => array(
			'left'    => esc_html__( 'Left', 'iconsult' ),
			'right'   => esc_html__( 'Right', 'iconsult' ),
			),
	) );
	
}

?>