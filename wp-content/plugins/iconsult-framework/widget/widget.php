<?php 

/******************************************
 ***  KNOWLEDGEBASE :: CUSTOM CATEGORY ***
******************************************/

class iconsult__kbcategory_custom extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'widget_kb_custom_catategory',
		// Widget name will appear in UI
		esc_html__('KB Custom Category', 'iconsult-framework'),
		// Widget description
		array( 'description' => esc_html__( 'Display custom knowledgebase category', 'iconsult-framework' ), )
		);
	} // Eof __construct
	
	
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		
		echo wp_kses_post($args['before_widget']);
			echo '<div class="widget_custom_kb_category">';
				if ( ! empty( $title ) ) echo '<h6>' . $title . '</h6>';
				
					if( $instance['cat_list'] != '' ) {
					 echo '<ul>';
					   wp_list_categories( array(
						  'orderby' => 'name',
						  'pad_counts' => 0,
						  'hierarchical' => false,
						  'taxonomy' => 'iconsultkbcat',
						  'title_li' => '',
						  'include' => $instance['cat_list'],
						) );
					 echo '</ul>';
					}
				
			echo '<div style="clear:both"></div>';
			echo '</div>';
		echo wp_kses_post($args['after_widget']);
	}
	
	// Widget Backend
	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'New title', 'iconsult-framework' );
		}
		
		$select = array();
		if ( isset( $instance[ 'cat_list' ] ) ) {
			$select = $instance[ 'cat_list' ];
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'iconsult-framework' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'cat_list' )); ?>"><?php esc_html_e( 'Select Category:', 'iconsult-framework' ); ?></label>
		 <?php 
			 $cat_list = get_categories( array( 'taxonomy' => 'iconsultkbcat' ) );
			 
			printf (
                '<select multiple="multiple" name="%s[]" id="%s" class="widefat" size="15" style="margin:10px 0px">',
                $this->get_field_name('cat_list'),
                $this->get_field_id('cat_list')
            );

            // Each individual option
            foreach( $cat_list as $cat )
            {
                printf(
                    '<option value="%s" %s style="margin-bottom:3px;">%s</option>',
                    $cat->cat_ID,
                    in_array( $cat->cat_ID, $select) ? 'selected="selected"' : '',
                    $cat->cat_name
                );
            }

            echo '</select>';
			 
		 ?>
         </p>
         
         <?php 
		
	} // Eof public form
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['cat_list'] = ( ! empty( $new_instance['cat_list'] ) ) ? esc_sql( $new_instance['cat_list'] ) : '';
		return $instance;
	}
	
}


// Register and load the widget
function iconsult__widget_custom_category() { register_widget( 'iconsult__kbcategory_custom' ); }
add_action( 'widgets_init', 'iconsult__widget_custom_category' );




/******************************************
 ***  KNOWLEDGEBASE :: DEFAULT CATEGORY ***
******************************************/
class iconsult__kbdefault_category extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'widget_kb_default_category',
		// Widget name will appear in UI
		esc_html__('KB Categroy', 'iconsult-framework'),
		// Widget description
		array( 'description' => esc_html__( 'KB records based on category', 'iconsult-framework' ), )
		);
	}

	// This is where the action happens
	public function widget( $args, $instance ) {
		global $post;
		$title = apply_filters( 'widget_title', $instance['title'] );
		if( $instance['cat_count'] == 1 ) { $show_count = 1; } else { $show_count = 0; }
		if( $instance['cat_hierarchy'] == 1 ) { $cat_hierarchy = 1; } else { $cat_hierarchy = 0; }
		// before and after widget arguments are defined by themes
		
		echo wp_kses_post($args['before_widget']);
			echo '<div class="widget_kb_default_category">';
				if ( ! empty( $title ) ) echo '<h6>' . $title . '</h6>';
				
				// Select current cat
				$currentKBID = '';
				$terms_kb_selectCatID = get_the_terms( $post->ID, 'iconsultkbcat' );
				//print_r($terms_kb_selectCatID); 
				if ( $terms_kb_selectCatID != null ){  
					$currentKBID = array();
					foreach( $terms_kb_selectCatID as $terms_kb_selectCatID ) {
						$currentKBID[] = $terms_kb_selectCatID->term_taxonomy_id;
						unset($terms_kb_selectCatID);
					}
					if( (array) !empty($currentKBID) ) {
						$kbcatID = implode(",",$currentKBID);
					} else {
						$kbcatID = 0;
					}
				} else {
					$kbcatID = 0;
				}
					 echo '<ul>';
						 wp_list_categories( array(
							  'orderby' => 'name',
							  'show_count' => $show_count,
							  'pad_counts' => 0,
							  'hierarchical' => $cat_hierarchy,
							  'taxonomy' => 'iconsultkbcat',
							  'current_category' => $kbcatID,
							  'title_li' => ''
							) );
					 echo '</ul>';
			echo '<div style="clear:both"></div>';
			echo '</div>';
		echo wp_kses_post($args['after_widget']);
	}
         
	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'New title', 'iconsult-framework' );
		}
		
		$cat_count = (isset($instance[ 'cat_count' ])?$instance[ 'cat_count' ]:'');
		$cat_hierarchy = (isset($instance[ 'cat_hierarchy' ])?$instance[ 'cat_hierarchy' ]:'');
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'iconsult-framework' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<input name="<?php echo esc_attr($this->get_field_name( 'cat_count' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'cat_count' )); ?>" type="checkbox" value="1" <?php if( $cat_count == 1 ){ echo 'checked'; } ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'cat_count' )); ?>"><?php esc_html_e( 'Show post counts', 'iconsult-framework' ); ?></label>
		</p>

		<p>
			<input name="<?php echo esc_attr($this->get_field_name( 'cat_hierarchy' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'cat_hierarchy' )); ?>" type="checkbox" value="1" <?php if( $cat_hierarchy == 1 ){ echo 'checked'; } ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'cat_hierarchy' )); ?>"><?php esc_html_e( 'Show hierarchy', 'iconsult-framework' ); ?></label>
		</p>


		<?php		
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['cat_dropdown'] = ( ! empty( $new_instance['cat_dropdown'] ) ) ? strip_tags( $new_instance['cat_dropdown'] ) : '';
		$instance['cat_count'] = ( ! empty( $new_instance['cat_count'] ) ) ? strip_tags( $new_instance['cat_count'] ) : '';
		$instance['cat_hierarchy'] = ( ! empty( $new_instance['cat_hierarchy'] ) ) ? strip_tags( $new_instance['cat_hierarchy'] ) : '';
		return $instance;
	}

}
 
// Register and load the widget
function iconsult__widget_default_category() { register_widget( 'iconsult__kbdefault_category' ); }
add_action( 'widgets_init', 'iconsult__widget_default_category' );





/******************************************
 ***  KNOWLEDGEBASE :: ARTICLES ***
******************************************/
class iconsult__kbarticles_bytype extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'widget_kb_article_by_type',
		// Widget name will appear in UI
		esc_html__('KB Articles', 'iconsult-framework'),
		// Widget description
		array( 'description' => esc_html__( 'KB articles (latest, popular, top rated and the most commented articles)', 'iconsult-framework' ), )
		);
	}
	
	// This is where the action happens
	public function widget( $args, $instance ) {
		global $post;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$knowledgebase_article_number = $instance['article_number'];
		$knowledgebase_article_order = $instance[ 'article_order' ];
		
		if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 1 ) { // Latest Article
			$kb_args = array( 
						'posts_per_page' => $knowledgebase_article_number, 
						'post_type'  => 'iconsult_kb',
						'orderby' => 'date',
						'order'	=>	$knowledgebase_article_order,
					);
		} else if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 2 ) { // Popular Article
			$kb_args = array( 
							'posts_per_page' => $knowledgebase_article_number, 
							'post_type'  => 'iconsult_kb',
							'orderby' => 'meta_value',
							'order'	=>	$knowledgebase_article_order,
							'meta_key' => 'display_post_impression'
						);
		} else if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 3 ) { // Top Rated Article
			$kb_args = array( 
							'posts_per_page' => $knowledgebase_article_number, 
							'post_type'  => 'iconsult_kb',
							'orderby' => 'meta_value',
							'order'	=>	$knowledgebase_article_order,
							'meta_key' => 'rating_like_count_post'
						);
		} else if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 4 ) { // Most Commented Article
			$kb_args = array( 
							'posts_per_page' => $knowledgebase_article_number, 
							'post_type'  => 'iconsult_kb',
							'orderby' => 'comment_count',
							'order'	=>	$knowledgebase_article_order,
						);
		}
		
		echo wp_kses_post($args['before_widget']);
		echo '<div class="kb_article_bytype">';
			if ( ! empty( $title ) ) echo '<h6>' . $title . '</h6>';
			$query = new WP_Query($kb_args);
			echo '<ul class="clearfix">';
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
			echo '<li class="articles"><a href="'.get_permalink($query->post->ID).'" rel="bookmark">'.get_the_title($query->post->ID).'</a></li>';
			endwhile; endif;
			echo '</ul>'; 
		wp_reset_postdata();
		echo '</div>';
		echo wp_kses_post($args['after_widget']);
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['display_type'] = ( ! empty( $new_instance['display_type'] ) ) ? strip_tags( $new_instance['display_type'] ) : '';
		$instance['article_number'] = ( ! empty( $new_instance['article_number'] ) ) ? strip_tags( $new_instance['article_number'] ) : '';
		$instance['article_order'] = ( ! empty( $new_instance['article_order'] ) ) ? strip_tags( $new_instance['article_order'] ) : '';
		return $instance;
	}
	
	// Widget Backend
	public function form( $instance ) {
		
		// title
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'New title', 'iconsult-framework' );
		}
		
		// display
		$latest_article = $popular_article = $top_rated_article = $most_commented_article = '';
		if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 1 ) $latest_article = 'selected';
		else if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 2 ) $popular_article = 'selected';
		else if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 3 ) $top_rated_article = 'selected';
		else if(  isset($instance[ 'display_type' ]) && $instance[ 'display_type' ] == 4 ) $most_commented_article = 'selected';
		
		// article number
		if ( isset( $instance[ 'article_number' ] ) ) {
			$article_number = $instance[ 'article_number' ];
		} else {
			$article_number = 5;
		}
		
		// order
		$ascending_order = $descending_order = '';
		if(  isset($instance[ 'article_order' ]) && $instance[ 'article_order' ] == 'ASC' ) { $ascending_order = 'selected';  }
		else if(  isset($instance[ 'article_order' ]) && $instance[ 'article_order' ] == 'DESC' ) { $descending_order = 'selected';  }

		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'iconsult-framework' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'Article Display Type' )); ?>"><?php esc_html_e( 'Article Display Type', 'iconsult-framework' ); ?></label>
        <select id="<?php echo esc_attr($this->get_field_id( 'display_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'display_type' )); ?>">
            <option value="1" <?php echo esc_attr($latest_article); ?>>Latest Articles (using date)</option>
            <option value="2" <?php echo esc_attr($popular_article); ?>>Popular Article (using number of views)</option>
            <option value="3" <?php echo esc_attr($top_rated_article); ?>>Top Rated Article (using like)</option>
            <option value="4" <?php echo esc_attr($most_commented_article); ?>>Most Commented Article</option>
        </select>
        </p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'Number of Articles' )); ?>"><?php esc_html_e( 'Number of Articles:', 'iconsult-framework' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'article_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'article_number' )); ?>" type="text" value="<?php echo esc_attr( $article_number ); ?>" />
		</p>
        
        
         <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'Article Order' )); ?>"><?php esc_html_e( 'Article Order', 'iconsult-framework' ); ?></label>
        <select id="<?php echo esc_attr($this->get_field_id( 'article_order' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'article_order' )); ?>">
            <option value="ASC" <?php echo esc_attr($ascending_order); ?>>Ascending Order</option>
            <option value="DESC" <?php echo esc_attr($descending_order); ?>>Descending Order</option>
        </select>
        </p>


		<?php		
	}
	
} // Class wpb_widget ends here
 
// Register and load the widget
function iconsult__widget_kb_articles() { register_widget( 'iconsult__kbarticles_bytype' ); }
add_action( 'widgets_init', 'iconsult__widget_kb_articles' );





/******************************************
 ***  WOOCOMMERCE DROPDOWN CART ***
******************************************/
class iconsult__woocommerce_menu_cart extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'woocommerce-menu-cart', // Base ID
			'Woocommerce Nav Menu', // Name
			array( 'description' => __( 'Woocommerce Nav Menu', 'iconsult-framework' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		global $post, $woocommerce, $iconsult_theme_options;
		echo '<div class="shopping_cart_outer">
		<div class="shopping_cart_inner">
		<div class="shopping_cart_header">
		<a class="fa fa-shopping-basket header_cart" href="'.wc_get_cart_url().'"><span class="header_cart_span">'. $woocommerce->cart->cart_contents_count.'</span></a>
			<div class="shopping_cart_dropdown">
			<div class="shopping_cart_dropdown_inner">';
            
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
			$list_class = array( 'cart_list', 'product_list_widget' );
					echo '<ul class="'. implode(' ', $list_class).'">';
						if ( !$cart_is_empty ) : 
							foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
								$_product = $cart_item['data'];
								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}
								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? ( function_exists( 'wc_get_price_excluding_tax' )? wc_get_price_excluding_tax( $_product ): $_product->get_price_excluding_tax() ) /*$_product->get_price_excluding_tax()*/ : $_product->get_price_including_tax();
								$product_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key );
								echo '<li>';
								echo '<a href="'. get_permalink( $cart_item['product_id'] ) .'">';
								echo ''.$_product->get_image().''; 
								echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product );
								echo '</a>';
								echo wc_get_formatted_cart_item_data( $cart_item ); 
								echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); 
							    echo '</li>';
						endforeach;
						else :
					echo '<li>'. __( 'No products in the cart.', 'iconsult-framework' ).'</li>';
				endif;
                echo '</ul></div>';
	         if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) :
                endif; 
			 echo '<a href="'. wc_get_cart_url() .'" class="qbutton white view-cart">'. __( 'Cart', 'iconsult-framework' ).'<i class="fa fa-shopping-basket"></i></a>';
			 echo '<span class="total">'. __( 'Total', 'iconsult-framework' ).':<span>'. $woocommerce->cart->get_cart_subtotal() .'</span></span>';
			 if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : 
			 endif;
		echo '</div></div></div></div>';
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		return $instance;
	}
} 
add_action( 'widgets_init', function() { register_widget( 'iconsult__woocommerce_menu_cart' ); } );





/******************************************
 ***  FAQ :: CATEGORY ***
******************************************/
class iconsult__faq extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'faq_category_widget',
		// Widget name will appear in UI
		esc_html__('FAQ Categroy', 'iconsult-framework'),
		// Widget description
		array( 'description' => esc_html__( 'Faq records based on category', 'iconsult-framework' ), )
		);
	}

	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		if( $instance['cat_count'] == 1 ) { $show_count = 1; } else { $show_count = 0; }
		if( $instance['cat_hierarchy'] == 1 ) { $cat_hierarchy = 1; } else { $cat_hierarchy = 0; }
		// before and after widget arguments are defined by themes
		
		echo wp_kses_post($args['before_widget']);
			echo '<div class="display-faq-section">';
				if ( ! empty( $title ) ) echo '<h6>' . $title . '</h6>';
				
				$customPostTaxonomies = get_object_taxonomies('iconsult_faq');
				if(count($customPostTaxonomies) > 0) {    
					 echo '<ul>';
					 foreach($customPostTaxonomies as $tax) {
						 wp_list_categories( array(
							  'orderby' => 'name',
							  'show_count' => $show_count,
							  'pad_counts' => 0,
							  'hierarchical' => $cat_hierarchy,
							  'taxonomy' => $tax,
							  'title_li' => ''
							) );
					 }	
					 echo '</ul>';
				}
			echo '<div style="clear:both"></div>';
			echo '</div>';
		echo wp_kses_post($args['after_widget']);
	}
         
	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'New title', 'iconsult-framework' );
		}
		
		$cat_count = (isset($instance[ 'cat_count' ])?$instance[ 'cat_count' ]:'');
		$cat_hierarchy = (isset($instance[ 'cat_hierarchy' ])?$instance[ 'cat_hierarchy' ]:''); 
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'iconsult-framework' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		
		<p><input name="<?php echo esc_attr($this->get_field_name( 'cat_count' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'cat_count' )); ?>" type="checkbox" value="1" <?php if( $cat_count == 1 ){ echo 'checked'; } ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'cat_count' )); ?>"><?php esc_html_e( 'Show post counts', 'iconsult-framework' ); ?></label></p>

		<p><input name="<?php echo esc_attr($this->get_field_name( 'cat_hierarchy' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'cat_hierarchy' )); ?>" type="checkbox" value="1" <?php if( $cat_hierarchy == 1 ){ echo 'checked'; } ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'cat_hierarchy' )); ?>"><?php esc_html_e( 'Show hierarchy', 'iconsult-framework' ); ?></label></p>
		<?php		
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['cat_dropdown'] = ( ! empty( $new_instance['cat_dropdown'] ) ) ? strip_tags( $new_instance['cat_dropdown'] ) : '';
		$instance['cat_count'] = ( ! empty( $new_instance['cat_count'] ) ) ? strip_tags( $new_instance['cat_count'] ) : '';
		$instance['cat_hierarchy'] = ( ! empty( $new_instance['cat_hierarchy'] ) ) ? strip_tags( $new_instance['cat_hierarchy'] ) : '';
		return $instance;
	}

} // Class wpb_widget ends here
 
// Register and load the widget
function iconsult__load_faq_widget() { register_widget( 'iconsult__faq' ); }
add_action( 'widgets_init', 'iconsult__load_faq_widget' );


/******************************************
 ***  ICON WITH TEXT :: WIDGET ***
******************************************/
class iconsult__icon_with_text_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'icon_with_text_widget',
		// Widget name will appear in UI
		esc_html__('iconsult - Icon With Text', 'iconsult-framework'),
		// Widget description
		array( 'description' => esc_html__( 'Display icon with text information on the menu header', 'iconsult-framework' ), )
		);
		
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}
	
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
	}
	
	public function print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.color-picker' ).wpColorPicker( {
						change: _.throttle( function() { // For Customizer
							$(this).trigger( 'change' );
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}
	
	
	// This is where the action happens
	public function widget( $args, $instance ) {
		$icon_name = ( isset( $instance['icon_name'] ) ? $instance['icon_name'] : '' );
		$text_color = ( isset( $instance['text_color'] ) ? $instance['text_color'] : '' );
		$icon_name_color = ( isset( $instance['icon_name_color'] ) ? $instance['icon_name_color'] : '' );
		$text_size = ( isset( $instance['text_size'] ) ? $instance['text_size'] : '' );
		$icon_margin = ( isset( $instance['icon_margin'] ) ? $instance['icon_margin'] : '' );
		$box_margin = ( isset( $instance['box_margin'] ) ? $instance['box_margin'] : '' );
		$icon_font_size = ( isset( $instance['icon_font_size'] ) ? $instance['icon_font_size'] : '' );
		
		echo wp_kses_post($args['before_widget']);
			echo '<div class="icon_text clearfix" style="margin:'.$box_margin.';">
					<div class="icon" style="color:'.$icon_name_color.';font-size:'.$icon_font_size.';margin:'.$icon_margin.';"><i class="'.$icon_name.'"></i></div>
					<div class="text" style="color:'.$text_color.';font-size:'.$text_size.';">'.$instance['message'].'</div>
				  </div>';
		echo wp_kses_post($args['after_widget']);
	}
	
	// Widget Backend
	public function form( $instance ) {
		
		$icon_name = ( isset( $instance['icon_name'] ) ? $instance['icon_name'] : '' );
		$icon_name_color = ( isset( $instance['icon_name_color'] ) ? $instance['icon_name_color'] : '' );
		$message = ( isset( $instance['message'] ) ? $instance['message'] : '' );
		$text_size = ( isset( $instance['text_size'] ) ? $instance['text_size'] : '' );
		$icon_font_size = ( isset( $instance['icon_font_size'] ) ? $instance['icon_font_size'] : '' );
		$icon_margin = ( isset( $instance['icon_margin'] ) ? $instance['icon_margin'] : '' );
		$box_margin = ( isset( $instance['box_margin'] ) ? $instance['box_margin'] : '' );
		$text_color = ( isset( $instance['text_color'] ) ? $instance['text_color'] : '' );
		?>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'box_margin' )); ?>"><?php esc_html_e( 'Icon With Text Box Margin:', 'iconsult-framework' ); ?></label>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'box_margin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'box_margin' )); ?>" value="<?php echo esc_attr( $box_margin ); ?>" /><br><i><?php esc_html_e( 'Default: 0px 0px 0px 62px', 'iconsult-framework' ); ?></i></p>  
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'icon_name_color' )); ?>"><?php esc_html_e( 'Icon Color:', 'iconsult-framework' ); ?></label>
        <input class="color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_name_color' )); ?>" name="<?php echo esc_attr(esc_attr($this->get_field_name( 'icon_name_color' ))); ?>" value="<?php echo esc_attr( $icon_name_color ); ?>" /></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'icon_font_size' )); ?>"><?php esc_html_e( 'Icon Font Size:', 'iconsult-framework' ); ?></label>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_font_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_font_size' )); ?>" value="<?php echo esc_attr( $icon_font_size ); ?>" /><br><i><?php esc_html_e( 'Default: 21px', 'iconsult-framework' ); ?></i></p>  
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'icon_margin' )); ?>"><?php esc_html_e( 'Icon Margin:', 'iconsult-framework' ); ?></label>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_margin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_margin' )); ?>" value="<?php echo esc_attr( $icon_margin ); ?>" /><br><i><?php esc_html_e( 'Default: 0px 14px 0px 0px', 'iconsult-framework' ); ?></i></p>  

        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'icon_name' )); ?>"><?php esc_html_e( 'Icon Name:', 'iconsult-framework' ); ?></label>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_name' )); ?>" value="<?php echo esc_attr( $icon_name ); ?>" /><br><i><?php esc_html_e( 'example: fa fa-youtube', 'iconsult-framework' ); ?></i>, <br><br>Use fontawesome font Icon Name: <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a></p> 
        
        <p><br></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'message' )); ?>"><?php esc_html_e( 'Text:', 'iconsult-framework' ); ?></label>
        <textarea class="widefat" rows="2" cols="7" id="<?php echo esc_attr($this->get_field_id('message')); ?>" name="<?php echo esc_attr($this->get_field_name('message')); ?>"><?php echo ''.$message; ?></textarea></p> 
            
        <p><label for="<?php echo esc_attr($this->get_field_id( 'text_color' )); ?>"><?php esc_html_e( 'Text Color:', 'iconsult-framework' ); ?></label>
        <input class="color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'text_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_color' )); ?>" value="<?php echo esc_attr( $text_color ); ?>" /></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'text_size' )); ?>"><?php esc_html_e( 'Text Size:', 'iconsult-framework' ); ?></label>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'text_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_size' )); ?>" value="<?php echo esc_attr( $text_size ); ?>" /><br><i><?php esc_html_e( 'Default: 13px', 'iconsult-framework' ); ?></i></p>  
         
        <?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['icon_name'] = ( ! empty( $new_instance['icon_name'] ) ) ? strip_tags( $new_instance['icon_name'] ) : '';
		$instance['message'] = ( ! empty( $new_instance['message'] ) ) ? $new_instance['message'] : '';
		$instance['text_size'] = ( ! empty( $new_instance['text_size'] ) ) ? $new_instance['text_size'] : '';
		$instance['icon_font_size'] = ( ! empty( $new_instance['icon_font_size'] ) ) ? $new_instance['icon_font_size'] : '';
		$instance['icon_margin'] = ( ! empty( $new_instance['icon_margin'] ) ) ? $new_instance['icon_margin'] : '';
		$instance['box_margin'] = ( ! empty( $new_instance['box_margin'] ) ) ? $new_instance['box_margin'] : '';
		$instance['text_color'] = $new_instance['text_color'];
		$instance['icon_name_color'] = $new_instance['icon_name_color'];
		return $instance;
	}
	
} // Class wpb_widget ends here

// Register and load the widget
function iconsult__load_icon_with_text_widget() { register_widget( 'iconsult__icon_with_text_widget' ); }
add_action( 'widgets_init', 'iconsult__load_icon_with_text_widget' );
?>