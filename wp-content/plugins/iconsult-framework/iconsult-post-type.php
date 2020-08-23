<?php 
/********************************
*** PORTFOLIO POST TYPE  ***
***********************************/
if ( ! function_exists( 'iconsult__portfolio_post_type' ) ) {
	function iconsult__portfolio_post_type() {
		
		global $iconsult_theme_options;
	
		if( isset($iconsult_theme_options['portfolio-slug-name']) && $iconsult_theme_options['portfolio-slug-name'] != ''  ) {
			$single_slug_name = $iconsult_theme_options['portfolio-slug-name'];
		} else {
			$single_slug_name = 'work';
		}
		
		register_post_type( 'iconsult_portfolio',
			array(
			'labels' => array(
					'name' => esc_html__( 'Portfolio', 'iconsult-framework' ),
					'singular_name' => esc_html__( 'Portfolio', 'iconsult-framework' ),
					'add_new' => esc_html__('Add Portfolio', 'iconsult-framework'),  
					'add_new_item' => esc_html__('Add New Portfolio', 'iconsult-framework'),  
					'edit_item' => esc_html__('Edit Portfolio', 'iconsult-framework'),  
					'new_item' => esc_html__('New Portfolio', 'iconsult-framework'),  
					'view_item' => esc_html__('View Portfolio', 'iconsult-framework'),  
					'search_items' => esc_html__('Search Portfolio', 'iconsult-framework'),  
					'not_found' =>  esc_html__('No Portfolio found', 'iconsult-framework'),  
					'not_found_in_trash' => esc_html__('No Portfolio found in Trash', 'iconsult-framework')
				),
			'taxonomies'  => array( 'iconsultptfocategory' ),	
			'public' => true,
			'menu_position' => 5,
			'rewrite' => array(	'slug' => $single_slug_name,
								'hierarchical' => 'true',
								'with_front' => false),
			'supports' => array(
				'title',
				'editor',
				'page-attributes','thumbnail', 'comments'), // add page attribute comments
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'hierarchical' => false,
			'exclude_from_search' => false,
			'show_in_nav_menus'  => false,
			'taxonomies' => array('post_tag'),
			'menu_icon'  => 'dashicons-portfolio',
			//'has_archive'   => true
			)
		);	
		flush_rewrite_rules();
	}
add_action( 'init', 'iconsult__portfolio_post_type' );	
}


if ( ! function_exists('iconsult__portfolio_category_taxonomy') ) {
	// Register faq Category Custom Taxonomy
	function iconsult__portfolio_category_taxonomy()  {
		
		$labels = array(
			'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'iconsult-framework' ),
			'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'iconsult-framework' ),
			'menu_name'                  => esc_html__( 'Portfolio Categories', 'iconsult-framework' ),
			'all_items'                  => esc_html__( 'All Categories', 'iconsult-framework' ),
			'parent_item'                => esc_html__( 'Parent Category', 'iconsult-framework' ),
			'parent_item_colon'          => esc_html__( 'Parent Category:', 'iconsult-framework' ),
			'new_item_name'              => esc_html__( 'New Category Name', 'iconsult-framework' ),
			'add_new_item'               => esc_html__( 'Add New Category', 'iconsult-framework' ),
			'edit_item'                  => esc_html__( 'Edit Category', 'iconsult-framework' ),
			'update_item'                => esc_html__( 'Update Category', 'iconsult-framework' ),
			'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'iconsult-framework' ),
			'search_items'               => esc_html__( 'Search categories', 'iconsult-framework' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'iconsult-framework' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'iconsult-framework' ),
		);
	
		$rewrite = array(
			'slug'                       => 'pfocat',  // change cat slug name
			'with_front'                 => false,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'query_var'                  => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'iconsultptfocategory', 'iconsult_portfolio', $args );
		flush_rewrite_rules();
	}
add_action( 'init', 'iconsult__portfolio_category_taxonomy', 0 );	
}






/********************************
*** TESTIMONIAL BLOCKS  ***
***********************************/
if ( ! function_exists( 'iconsult__testimonial_menu_block' ) ) {
	function iconsult__testimonial_menu_block() {
		register_post_type( 'iconsult_testimonial',
			array(
				'public' => true,
				'publicly_queryable' => false,
				'show_in_nav_menus' => false,
				'show_in_admin_bar' => true,
				'menu_position' => 5,
				'exclude_from_search' => true,
				'hierarchical' => false,
				'map_meta_cap' => true,
				'menu_icon'  => 'dashicons-testimonial',
				'labels' => array(
						'name' => esc_html__( 'Testimonial', 'iconsult-framework' ),
						'singular_name' => esc_html__( 'Testimonial', 'iconsult-framework' ),
						'add_new' => esc_html__('Add New Testimonial', 'iconsult-framework'),  
						'add_new_item' => esc_html__('Add New Testimonial', 'iconsult-framework'),  
						'edit_item' => esc_html__('Edit Testimonial', 'iconsult-framework'),  
						'new_item' => esc_html__('New Testimonial', 'iconsult-framework'),  
						'view_item' => esc_html__('View Testimonial', 'iconsult-framework'),  
						'search_items' => esc_html__('Search Testimonial', 'iconsult-framework'),  
						'not_found' =>  esc_html__('No Testimonial found', 'iconsult-framework'),  
						'not_found_in_trash' => esc_html__('No Testimonial Found In Trash', 'iconsult-framework')
					),
				'supports' => array('title','page-attributes'),
				'taxonomies'  => array( 'bindtestimonialcat' ),
				)
		);
	}
add_action( 'init', 'iconsult__testimonial_menu_block' );	
}

if ( ! function_exists('iconsult__testimonial_category_taxonomy') ) {
function iconsult__testimonial_category_taxonomy()  {
	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'iconsult-framework' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'iconsult-framework' ),
		'menu_name'                  => esc_html__( 'Categories', 'iconsult-framework' ),
		'all_items'                  => esc_html__( 'All Categories', 'iconsult-framework' ),
		'parent_item'                => esc_html__( 'Parent Category', 'iconsult-framework' ),
		'parent_item_colon'          => esc_html__( 'Parent Category:', 'iconsult-framework' ),
		'new_item_name'              => esc_html__( 'New Category Name', 'iconsult-framework' ),
		'add_new_item'               => esc_html__( 'Add New Category', 'iconsult-framework' ),
		'edit_item'                  => esc_html__( 'Edit Category', 'iconsult-framework' ),
		'update_item'                => esc_html__( 'Update Category', 'iconsult-framework' ),
		'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'iconsult-framework' ),
		'search_items'               => esc_html__( 'Search categories', 'iconsult-framework' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'iconsult-framework' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'iconsult-framework' ),
	);
	$rewrite = array(
		'slug'                       => 'testimonials_category',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'query_var'                  => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'bindtestimonialcat', 'iconsult_testimonial', $args );
	flush_rewrite_rules();
}
add_action( 'init', 'iconsult__testimonial_category_taxonomy', 0 );
}	



/********************************
*** KNOWLEDGEBASE POST TYPES  ***
***********************************/
if ( ! function_exists('iconsult__kbase_post_type') ) {
	function iconsult__kbase_post_type() {
		global $iconsult_theme_options;
	
		if( isset($iconsult_theme_options['kb_slug_name']) && $iconsult_theme_options['kb_slug_name'] != ''  ) {
			$single_slug_name = $iconsult_theme_options['kb_slug_name'];
		} else {
			$single_slug_name = 'knowledgebase';
		}
		
		$labels = array(
			'name'                => esc_html__( 'Knowledge Base', 'iconsult-framework' ),
			'singular_name'       => esc_html__( 'Knowledge Base', 'iconsult-framework' ),
			'menu_name'           => esc_html__( 'Knowledge Base', 'iconsult-framework' ),
			'parent_item_colon'   => esc_html__( 'Parent Knowledge Base:', 'iconsult-framework' ),
			'all_items'           => esc_html__( 'All Knowledge Base', 'iconsult-framework' ),
			'view_item'           => esc_html__( 'View Knowledge Base', 'iconsult-framework' ),
			'add_new_item'        => esc_html__( 'Add New Knowledge Base', 'iconsult-framework' ),
			'add_new'             => esc_html__( 'New Knowledge Base', 'iconsult-framework' ),
			'edit_item'           => esc_html__( 'Edit Knowledge Base', 'iconsult-framework' ),
			'update_item'         => esc_html__( 'Update Knowledge Base', 'iconsult-framework' ),
			'search_items'        => esc_html__( 'Search Knowledge Base', 'iconsult-framework' ),
			'not_found'           => esc_html__( 'No Knowledge Base found', 'iconsult-framework' ),
			'not_found_in_trash'  => esc_html__( 'No Knowledge Base found in Trash', 'iconsult-framework' ),
		);
		$rewrite = array(
			'slug'                => $single_slug_name,
			'with_front'          => false,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => 'iconsult_kb',
			'description'         => esc_html__( 'Knowledge Base Post Type', 'iconsult-framework' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'author', 'revisions', 'editor', 'page-attributes', 'thumbnail', 'comments', 'post-formats' ),
			'taxonomies'          => array( 'iconsultkbcat' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'menu_icon'           => 'dashicons-book',
		);
		register_post_type( 'iconsult_kb', $args );
		flush_rewrite_rules();
	} // eof function
add_action( 'init', 'iconsult__kbase_post_type', 0 );	
} // eof if.


// CATEGORY POST TYPE KB
if ( ! function_exists('iconsult__kbcat_taxonomy') ) {
	function iconsult__kbcat_taxonomy()  {
		global $iconsult_theme_options;
		
		if( isset($iconsult_theme_options['kb_cat_slug_name']) && $iconsult_theme_options['kb_cat_slug_name'] != ''  ) {
			$new_cat_slug_name = $iconsult_theme_options['kb_cat_slug_name'];
		} else {
			$new_cat_slug_name = 'kb';
		}
	
		$labels = array(
			'name'                       => esc_html__( 'Knowledge Base Categories', 'iconsult-framework' ),
			'singular_name'              => esc_html__( 'Knowledge Base Category', 'iconsult-framework' ),
			'menu_name'                  => esc_html__( 'Knowledge Base Categories', 'iconsult-framework' ),
			'all_items'                  => esc_html__( 'All Categories', 'iconsult-framework' ),
			'parent_item'                => esc_html__( 'Parent Category', 'iconsult-framework' ),
			'parent_item_colon'          => esc_html__( 'Parent Category:', 'iconsult-framework' ),
			'new_item_name'              => esc_html__( 'New Category Name', 'iconsult-framework' ),
			'add_new_item'               => esc_html__( 'Add New Category', 'iconsult-framework' ),
			'edit_item'                  => esc_html__( 'Edit Category', 'iconsult-framework' ),
			'update_item'                => esc_html__( 'Update Category', 'iconsult-framework' ),
			'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'iconsult-framework' ),
			'search_items'               => esc_html__( 'Search categories', 'iconsult-framework' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'iconsult-framework' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'iconsult-framework' ),
		);
		$rewrite = array(
			'slug'                       => $new_cat_slug_name,
			'with_front'                 => false,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'query_var'                  => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'iconsultkbcat', 'iconsult_kb', $args );
		flush_rewrite_rules();
	} //eof function
add_action( 'init', 'iconsult__kbcat_taxonomy', 0 );
} // eof if


// TAG POST TYPE KB
if ( ! function_exists('iconsult__kbtag_taxonomy') ) {
	function iconsult__kbtag_taxonomy()  {
		global $iconsult_theme_options;
	
		if( isset($iconsult_theme_options['kb_tag_slug_name']) && $iconsult_theme_options['kb_tag_slug_name'] != ''  ) {
			$kb_tag_slug_name = $iconsult_theme_options['kb_tag_slug_name'];
		} else {
			$kb_tag_slug_name = 'kbtag';
		}
		
		$labels = array(
			'name'                       => esc_html__( 'Knowledge Base Tags', 'iconsult-framework' ),
			'singular_name'              => esc_html__( 'Knowledge Base Tag', 'iconsult-framework' ),
			'menu_name'                  => esc_html__( 'Knowledge Base Tags', 'iconsult-framework' ),
			'all_items'                  => esc_html__( 'All Tags', 'iconsult-framework' ),
			'parent_item'                => esc_html__( 'Parent Tag', 'iconsult-framework' ),
			'parent_item_colon'          => esc_html__( 'Parent Tag:', 'iconsult-framework' ),
			'new_item_name'              => esc_html__( 'New Tag Name', 'iconsult-framework' ),
			'add_new_item'               => esc_html__( 'Add New Tag', 'iconsult-framework' ),
			'edit_item'                  => esc_html__( 'Edit Tag', 'iconsult-framework' ),
			'update_item'                => esc_html__( 'Update Tag', 'iconsult-framework' ),
			'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'iconsult-framework' ),
			'search_items'               => esc_html__( 'Search tags', 'iconsult-framework' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove tags', 'iconsult-framework' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used tags', 'iconsult-framework' ),
		);
		$rewrite = array(
			'slug'                       => $kb_tag_slug_name,
			'with_front'                 => false,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'query_var'                  => 'article_tag',
			'rewrite'                    => $rewrite,
		);
	register_taxonomy( 'iconsult_kbtag', 'iconsult_kb', $args );
	} // eof function
add_action( 'init', 'iconsult__kbtag_taxonomy', 0 );
}


/********************************
*** FAQ POST TYPE  ***
***********************************/
if ( ! function_exists( 'iconsult__faq_post_type' ) ) {
	function iconsult__faq_post_type() {
		register_post_type( 'iconsult_faq',
			array(
			'labels' => array(
					'name' => esc_html__( 'FAQs', 'iconsult-framework' ),
					'singular_name' => esc_html__( 'FAQ', 'iconsult-framework' ),
					'add_new' => esc_html__('Add FAQ', 'iconsult-framework'),  
					'add_new_item' => esc_html__('Add New FAQ', 'iconsult-framework'),  
					'edit_item' => esc_html__('Edit FAQ', 'iconsult-framework'),  
					'new_item' => esc_html__('New FAQ', 'iconsult-framework'),  
					'view_item' => esc_html__('View FAQ', 'iconsult-framework'),  
					'search_items' => esc_html__('Search FAQs', 'iconsult-framework'),  
					'not_found' =>  esc_html__('No FAQs found', 'iconsult-framework'),  
					'not_found_in_trash' => esc_html__('No FAQs found in Trash', 'iconsult-framework')
				),
			'taxonomies'  => array( 'iconsultfaqcat' ),	
			'public' => true,
			'menu_position' => 5,
			'rewrite' => array(	'slug' => 'faqs',
								'hierarchical' => 'true',
								'with_front' => false),
			'supports' => array(
				'title',
				'editor',
				'page-attributes','thumbnail'),
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'hierarchical' => false,
			'exclude_from_search' => false,
			'show_in_nav_menus'  => false,
			'menu_icon'  => 'dashicons-editor-help',
 			//'has_archive'   => true
			)
		);	
		flush_rewrite_rules();
	} // eof function
add_action( 'init', 'iconsult__faq_post_type' );
}

if ( ! function_exists('iconsult__faq_category_taxonomy1') ) {
function iconsult__faq_category_taxonomy1()  {
	$labels = array(
		'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'iconsult-framework' ),
		'singular_name'              => _x( 'FAQ Category', 'Taxonomy Singular Name', 'iconsult-framework' ),
		'menu_name'                  => esc_html__( 'FAQ Categories', 'iconsult-framework' ),
		'all_items'                  => esc_html__( 'All Categories', 'iconsult-framework' ),
		'parent_item'                => esc_html__( 'Parent Category', 'iconsult-framework' ),
		'parent_item_colon'          => esc_html__( 'Parent Category:', 'iconsult-framework' ),
		'new_item_name'              => esc_html__( 'New Category Name', 'iconsult-framework' ),
		'add_new_item'               => esc_html__( 'Add New Category', 'iconsult-framework' ),
		'edit_item'                  => esc_html__( 'Edit Category', 'iconsult-framework' ),
		'update_item'                => esc_html__( 'Update Category', 'iconsult-framework' ),
		'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'iconsult-framework' ),
		'search_items'               => esc_html__( 'Search categories', 'iconsult-framework' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'iconsult-framework' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'iconsult-framework' ),
	);
	$rewrite = array(
		'slug'                       => 'faq',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'query_var'                  => 'article_category',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'iconsultfaqcat', 'iconsult_faq', $args );
	flush_rewrite_rules();
}
add_action( 'init', 'iconsult__faq_category_taxonomy1', 0 );
}	



/********************************
*** SERVICES POST TYPE  ***
***********************************/
if ( ! function_exists( 'iconsult__services_post_type' ) ) {
	function iconsult__services_post_type() {
		
		global $iconsult_theme_options;
	
		if( isset($iconsult_theme_options['services-slug-name']) && $iconsult_theme_options['services-slug-name'] != ''  ) {
			$single_slug_name = $iconsult_theme_options['services-slug-name'];
		} else {
			$single_slug_name = 'case';
		}
		
		register_post_type( 'iconsult_services',
			array(
			'labels' => array(
					'name' => esc_html__( 'Services', 'iconsult-framework' ),
					'singular_name' => esc_html__( 'Services', 'iconsult-framework' ),
					'add_new' => esc_html__('Add Services', 'iconsult-framework'),  
					'add_new_item' => esc_html__('Add New Services', 'iconsult-framework'),  
					'edit_item' => esc_html__('Edit Services', 'iconsult-framework'),  
					'new_item' => esc_html__('New Services', 'iconsult-framework'),  
					'view_item' => esc_html__('View Services', 'iconsult-framework'),  
					'search_items' => esc_html__('Search Services', 'iconsult-framework'),  
					'not_found' =>  esc_html__('No Services found', 'iconsult-framework'),  
					'not_found_in_trash' => esc_html__('No Services found in Trash', 'iconsult-framework')
				),
			'taxonomies'  => array( 'iconsultsvscat' ),	
			'public' => true,
			'menu_position' => 5,
			'rewrite' => array(	'slug' => $single_slug_name, 'hierarchical' => 'true', 'with_front' => false),
			'supports' => array( 'title', 'editor', 'page-attributes','thumbnail', 'comments'), 
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'hierarchical' => false,
			'exclude_from_search' => false,
			'show_in_nav_menus'  => false,
			'menu_icon'  => 'dashicons-clipboard',
			)
		);	
		flush_rewrite_rules();
	}
add_action( 'init', 'iconsult__services_post_type' );	
}

if ( ! function_exists('iconsult__services_category_taxonomy') ) {
	// Register faq Category Custom Taxonomy
	function iconsult__services_category_taxonomy()  {
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Taxonomy General Name', 'iconsult-framework' ),
			'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'iconsult-framework' ),
			'menu_name'                  => esc_html__( 'Categories', 'iconsult-framework' ),
			'all_items'                  => esc_html__( 'All Categories', 'iconsult-framework' ),
			'parent_item'                => esc_html__( 'Parent Category', 'iconsult-framework' ),
			'parent_item_colon'          => esc_html__( 'Parent Category:', 'iconsult-framework' ),
			'new_item_name'              => esc_html__( 'New Category Name', 'iconsult-framework' ),
			'add_new_item'               => esc_html__( 'Add New Category', 'iconsult-framework' ),
			'edit_item'                  => esc_html__( 'Edit Category', 'iconsult-framework' ),
			'update_item'                => esc_html__( 'Update Category', 'iconsult-framework' ),
			'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'iconsult-framework' ),
			'search_items'               => esc_html__( 'Search categories', 'iconsult-framework' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'iconsult-framework' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'iconsult-framework' ),
		);
	
		$rewrite = array(
			'slug'                       => 'bservicescat',  // change cat slug name
			'with_front'                 => false,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'query_var'                  => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'iconsultsvscat', 'iconsult_services', $args );
		flush_rewrite_rules();
	}
add_action( 'init', 'iconsult__services_category_taxonomy', 0 );	
}
?>