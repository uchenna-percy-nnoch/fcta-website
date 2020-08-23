<?php

/**
 * bbPress - Forum Archive
 *
 * @package bbPress
 * @subpackage Theme
 */

get_header();

$left_sidebar = false;
$right_sidebar = false;
$col_md_sm = 12;
if( $iconsult_theme_options['bbpress_display_sidebar_on_page_status'] ==  true ) {  
	if( $iconsult_theme_options['bbpress_display_sidebar_position_left_right'] == 'left' ) {  
		$left_sidebar = true;
		$right_sidebar = false;
		$col_md_sm = 9;
	}  else if( $iconsult_theme_options['bbpress_display_sidebar_position_left_right'] == 'right' ) {  
		$left_sidebar = false;
		$right_sidebar = true;
		$col_md_sm = 9;
	} else {
		$left_sidebar = false;
		$right_sidebar = false;
		$col_md_sm = 12;
	}
}

$container_call = iconsult_website_global_full_width_design_control(); 
?>
    <div class="<?php echo esc_html($container_call); ?> content-wrapper body-content">
    <div class="row margin-top-60 margin-bottom-60">
    
    	<?php if( $left_sidebar == true ) { ?>
        	<div class="left-widget-sidebar">
                <aside class="col-md-3 col-sm-3 sidebar-widget-box">
                <?php 
                if ( is_active_sidebar( 'bbpress-widget-1' ) ) : 
                    dynamic_sidebar( 'bbpress-widget-1' ); 
                endif; 
                ?>
                </aside>
            </div>  
		<?php } ?>
        
        <div class="col-md-<?php echo esc_html($col_md_sm); ?> col-sm-<?php echo esc_html($col_md_sm); ?>">  
		<!--Content Start-->
        
			<?php 
            if( $iconsult_theme_options['bbpress_display_search_on_page'] ==  true ) { echo iconsult__custom_search_form(); } 
            do_action( 'bbp_before_main_content' ); 
            do_action( 'bbp_template_notices' ); 
            ?>
                <div id="forum-front" class="bbp-forum-front">
                    <div class="entry-content">
                        <?php bbp_get_template_part( 'content', 'archive-forum' ); ?>
                    </div>
                </div><!-- #forum-front -->
            <?php do_action( 'bbp_after_main_content' ); ?>

		<!--Eof Content Start-->
		<div class="clearfix"></div>
        </div>
		
		<?php if( $right_sidebar == true ) { ?>
        <aside class="col-md-3 col-sm-3 sidebar-widget-box">
			<?php 
            if ( is_active_sidebar( 'bbpress-widget-1' ) ) : 
                dynamic_sidebar( 'bbpress-widget-1' ); 
            endif; 
            ?>
        </aside>
        <?php } ?>
        
    </div>
</div>
<?php get_footer(); ?>