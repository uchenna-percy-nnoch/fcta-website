<?php 
/**
 * The template for displaying all single page
 */
 
get_header();

$col_md_sm = 12;

if(is_shop() || is_product_category() || is_product_tag() ){  
	if( $iconsult_theme_options['woo_display_sidebar_on_product_listing_page'] ==  true ) {  
		if( $iconsult_theme_options['woo_display_sidebar_position_left_right'] == 'left' ) { 
			$col_md_sm = 9;
		}  else if( $iconsult_theme_options['woo_display_sidebar_position_left_right'] == 'right' ) { 
			$col_md_sm = 9;
		} else {  
			$col_md_sm = 12;
		}
	} else {
		$col_md_sm = 9;
	}
}

if( $iconsult_theme_options['woo_display_sidebar_position_left_right'] == 'left' ) {  
	$left_sidebar = true;
	$right_sidebar = false;
} else if( $iconsult_theme_options['woo_display_sidebar_position_left_right'] == 'right' ) { 
	$left_sidebar = false;
	$right_sidebar = true;
} else { 
	$left_sidebar = false;
	$right_sidebar = true;
}

if( $iconsult_theme_options['woo_display_sidebar_on_product_listing_page'] == false && is_shop() ) {  
	$left_sidebar = false;
	$right_sidebar = false;
	$col_md_sm = 12;
}

if( $iconsult_theme_options['woo_display_sidebar_on_single_product_page'] == true && is_product() ) {
	if( $iconsult_theme_options['woo_display_sidebar_position_left_right'] == 'left' ) {  
		$left_sidebar = true;
		$right_sidebar = false;
		$col_md_sm = 9;
	} else if( $iconsult_theme_options['woo_display_sidebar_position_left_right'] == 'right' ) { 
		$left_sidebar = false;
		$right_sidebar = true;
		$col_md_sm = 9;
	}
} else {
	if( is_product() ) {
		$left_sidebar = false;
		$right_sidebar = false;
		$col_md_sm = 12;
	}
}

$container_call = iconsult_website_global_full_width_design_control();   
?>
    <div class="<?php echo esc_html($container_call); ?> content-wrapper body-content">
    <div class="row margin-top-60">  <!--margin-bottom-60-->
    
		<?php 
		if( $left_sidebar == true ) { 
			if ( is_active_sidebar( 'woocommerce-widget-1' ) ) {
		?>
        	<div class="left-widget-sidebar">
                <aside class="col-md-3 col-sm-3 sidebar-widget-box"> <?php dynamic_sidebar( 'woocommerce-widget-1' ); ?> </aside>
            </div>  
		<?php }} ?>
        
    	<div class="col-md-<?php echo esc_html($col_md_sm); ?> col-sm-<?php echo esc_html($col_md_sm); ?>"> 
			<?php woocommerce_content(); ?>
        </div>
       
        <?php 
		if( $right_sidebar == true ) { 
			if ( is_active_sidebar( 'woocommerce-widget-1' ) ) {
		?>
        <aside class="col-md-3 col-sm-3 sidebar-widget-box"> <?php dynamic_sidebar( 'woocommerce-widget-1' ); ?> </aside>
        <?php 
			}
		} 
		?>
        
    </div>
</div>    

<?php get_footer(); ?>