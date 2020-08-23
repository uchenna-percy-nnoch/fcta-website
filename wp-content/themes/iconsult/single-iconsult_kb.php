<?php
/**
 * The template for displaying all single posts and attachments
 */
$terms = get_the_terms( $post->ID , 'iconsultkbcat' ); 
if( !empty($terms) ) { 

get_header(); 

$col_md  =  $col_sm = $right_sidebar = $left_sidebar = '';
if( $iconsult_theme_options['knowledgebase_sidebar_layout'] == 3 ) {
	$col_md_sm = 9;
	$right_sidebar = true;
	$left_sidebar = false;
} else if( $iconsult_theme_options['knowledgebase_sidebar_layout'] == 1 ) {
	$col_md_sm = 12;
	$right_sidebar = false;
	$left_sidebar = false;
} else if( $iconsult_theme_options['knowledgebase_sidebar_layout'] == 2 ) {
	$col_md_sm = 9;
	$right_sidebar = false;
	$left_sidebar = true;
} else {
	$col_md_sm = 9;
	$right_sidebar = false;
	$left_sidebar = true;
}

$container_call = iconsult_website_global_full_width_design_control();   
?>
    <div class="<?php echo esc_html($container_call); ?> content-wrapper body-content">
    <div class="row margin-top-60 margin-bottom-60">
    <div class="left-widget-sidebar"><?php if( $left_sidebar == true )  get_template_part('sidebar', 'kb');  ?></div>
        <div class="col-md-<?php echo esc_html($col_md_sm); ?> col-sm-<?php echo esc_html($col_md_sm); ?> kbpg"> 
        
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template/content', 'singlekb' );

			if( $iconsult_theme_options['kb-single-pg-comment-status'] == true ) { 
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}

			// End of the loop.
		endwhile;
		?>
        <div class="clearfix"></div>
        </div>
	<?php if( $right_sidebar == true )  get_template_part('sidebar', 'kb');  ?>
    </div>
</div>
<?php get_footer(); 
} else {
 esc_html_e( 'Please assign category for your Knowledge Base RECORD', 'iconsult' );	
} 
?>