<?php
/**
 * The template part for displaying results in search pages
*/
$iconsult_theme_options = iconsult__theme_option_global();
$col_md = $col_sm = $right_sidebar = $left_sidebar = '';
if( $iconsult_theme_options['blog_default_landing_pg_sidebar_layout'] == 3 ) { 
	$col_md_sm = 9;
	$right_sidebar = true;
	$left_sidebar = false;
} else if( $iconsult_theme_options['blog_default_landing_pg_sidebar_layout'] == 1 ) { 
	$col_md_sm = 12;
	$right_sidebar = false;
	$left_sidebar = false;
} else if( $iconsult_theme_options['blog_default_landing_pg_sidebar_layout'] == 2 ) {  
	$col_md_sm = 9;
	$right_sidebar = false;
	$left_sidebar = true;
} else {
	$col_md_sm = 9;
	$right_sidebar = true;
	$left_sidebar = false;
}
$container_call = iconsult_website_global_full_width_design_control(); 
?>

<!-- /start container -->
<div class="<?php echo esc_html($container_call); ?> content-wrapper body-content">
    <div class="row margin-top-60 margin-bottom-60">
    <?php if( $left_sidebar == true ) { ?><div class="left-widget-sidebar"><?php get_sidebar(); ?></div>  <?php } ?>
         <div class="col-md-<?php echo esc_html($col_md_sm); ?> col-sm-<?php echo esc_html($col_md_sm); ?> catkbpg"> 
         <div class="kb-categorypg">
          <?php 
		  		
				$is_plugin_active = iconsult__plugin_active('ReduxFramework');
				if($is_plugin_active == true){
					if( is_search() ) {
						echo '<div class="global-search">';
						echo iconsult__custom_search_form();
						echo '</div>';
					}
				}
			  
                if ( have_posts() ) : 
                // Start the loop.
                while ( have_posts() ) : the_post(); 
                   ?>
                   <div class="kb-box-single searchpg clearboth">
                   <div id="post-<?php the_ID(); ?>">
                       <div class="kb-single blog searchpg">
                            <div class="entry-header">
                                <?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
                            </div><!-- .entry-header -->
                            <!--<div class="entry-meta">
                                <?php //iconsult__entry_meta(); ?>
                            </div>--><!-- .entry-meta -->
                            <p class="searchpg_excerpt"><?php echo get_the_excerpt(); ?></p>
                        </div>    
                    </div>
                    </div>
                   <?php 
                endwhile;
                // Previous/next page navigation.
                the_posts_pagination( array(
                    'prev_text'          => esc_html__( '&lt;', 'iconsult' ),
                    'next_text'          => esc_html__( '&gt;', 'iconsult' ),
                ) );
            // If no content, include the "No posts found" template.
            else :
                esc_html_e( 'Sorry!! nothing found related to your search topic, please try search again.', 'iconsult' );
            endif;
            ?>
          <div class="clearfix"></div>
        </div>
        </div>
        <?php if( $right_sidebar == true )  get_sidebar(); ?>
    </div>
</div>