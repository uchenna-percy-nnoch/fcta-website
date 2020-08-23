<?php
/**
 * The template for displaying all single posts and attachments
 */
$terms = get_the_terms( $post->ID , 'iconsultfaqcat' ); 
if( !empty($terms) ) { 

get_header(); 

$col_md  =  $col_sm = $right_sidebar = $left_sidebar = '';
if( $iconsult_theme_options['faq_categorypg_layout'] == 3 ) {
	$col_md_sm = 9;
	$right_sidebar = true;
	$left_sidebar = false;
} else if( $iconsult_theme_options['faq_categorypg_layout'] == 1 ) {
	$col_md_sm = 12;
	$right_sidebar = false;
	$left_sidebar = false;
} else if( $iconsult_theme_options['faq_categorypg_layout'] == 2 ) {
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
    <div class="left-widget-sidebar"><?php if( $left_sidebar == true )  get_template_part('sidebar', 'faq');  ?></div>
        <div class="col-md-<?php echo esc_html($col_md_sm); ?> col-sm-<?php echo esc_html($col_md_sm); ?>"> 
        
        <?php 
        /**************************************
		** Search **
		***************************************/
		if( $iconsult_theme_options['faq_categorypg_search_status'] == true ) {
			echo iconsult__custom_search_form();
		}
		
        /**************************************
		** Display Records Related To Category **
		***************************************/
		$st_term_data =	$wp_query->queried_object;
		$term_slug = get_query_var( 'term' );	
		$args = array(
			'post_type' => 'iconsult_faq',
			'posts_per_page' => '-1',
			'order'    => $iconsult_theme_options['faq_categorypg_order'],
			'orderby'  => $iconsult_theme_options['faq_categorypg_order_by'],
			'tax_query' => array(
					array(
						'taxonomy' => 'iconsultfaqcat',
						'field' => 'slug',
						'include_children' => true,
						'terms' => $term_slug
						)
					),
		);
		$wp_query = new WP_Query($args);   
        
		if($wp_query->have_posts()) { 
			if ( have_posts() ) { 
			echo '<div class="display-faq-section margin-30">';
			while($wp_query->have_posts()) :  $wp_query->the_post(); 
			?>
				<div class="collapsible-panels theme-faq-cat-pg" id="<?php echo esc_attr($post->ID); ?>">
				  <h5 class="title-faq-cat"><a href="#"><?php echo get_the_title(); ?></a></h5>
				  <div class="entry-content clearfix">
					<?php the_content(); ?>
					<?php edit_post_link( esc_html__( 'Edit', 'iconsult' ), '<p class="edit-link" style="text-align:right">', '</p>', $post->ID ); ?>
				  </div>
				</div>
				
			<?php 
			endwhile; 
					
			// page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( '&lt;', 'iconsult' ),
					'next_text'          => esc_html__( '&gt;', 'iconsult' ),
				) );
			// Eof page navigation.
					
			echo '</div>';
			// If no content, include the "No posts found" template.
			} else {
				 esc_html_e( 'Sorry, no records were found', 'iconsult' );
			}
			
		}
		wp_reset_postdata(); 
		?>       

        <div class="clearfix"></div>
        </div>
	<?php if( $right_sidebar == true )  get_template_part('sidebar', 'faq');  ?>
    </div>
</div>
<?php get_footer(); 
} else {
 esc_html_e( 'Please assign category for your FAQ RECORD', 'iconsult' );	
} 
?>