<?php
/**
 * The template for displaying all single posts and attachments
 */
$terms = get_the_terms( $post->ID , 'iconsultkbcat' ); 
if( !empty($terms) ) { 

get_header(); 

$col_md  =  $col_sm = $right_sidebar = $left_sidebar = '';
if( $iconsult_theme_options['knowledgebase_categorypg_layout'] == 3 ) {
	$col_md_sm = 9;
	$right_sidebar = true;
	$left_sidebar = false;
} else if( $iconsult_theme_options['knowledgebase_categorypg_layout'] == 1 ) {
	$col_md_sm = 12;
	$right_sidebar = false;
	$left_sidebar = false;
} else if( $iconsult_theme_options['knowledgebase_categorypg_layout'] == 2 ) {
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
        <div class="col-md-<?php echo esc_html($col_md_sm); ?> col-sm-<?php echo esc_html($col_md_sm); ?> catkbpg"> 
        
        <?php 
		
        /**************************************
		** Search **
		***************************************/
		
		if( $iconsult_theme_options['kb-categorypg-search-status'] == true ) {
			echo iconsult__custom_search_form();
		}
		
        /**************************************
		** Display Records Related To CHILD Category **
		***************************************/
		$st_term_data =	$wp_query->queried_object;
		$term_slug = get_query_var( 'term' );
		$current_term = get_term_by( 'slug', $term_slug, 'iconsultkbcat' );
		$term_id = $current_term->term_id;

		$st_subcat_args = array(
		  'orderby' => 'name',
		  'order'   => 'ASC',
		  'child_of' => $term_id,
		  'parent' => $term_id
		);
		$st_sub_categories = get_terms('iconsultkbcat', $st_subcat_args);
		
		if ($st_sub_categories) {
			 // If the category has sub categories 
			$st_subcat_args = array(
			  'orderby' => 'name',
			  'order'   => 'ASC',
			  'child_of' => $term_id,
			  'parent' => $term_id
			);
			$st_sub_categories = get_terms('iconsultkbcat', $st_subcat_args);
			echo '<div class="kb_sub_category_section_wrap">'; 
			foreach($st_sub_categories as $st_sub_category) {
				echo '<div class="kb_sub_category_section">';
				  echo '<h5><a href="'.get_term_link($st_sub_category->slug, 'iconsultkbcat').'">';
                         $cat_title = $st_sub_category->name; 
                         echo html_entity_decode($cat_title, ENT_QUOTES, "UTF-8");
                   echo '</a>';
				   echo '</h5>&nbsp;('.$st_sub_category->count.')';
				   echo '<span class="separator small"></span>';
            	echo '</div>';
			} 
			echo '</div>';  
		} 


        /**************************************
		** Display Records Related To ROOT Category **
		***************************************/
		
        // PARENT CAT
		echo '<div class="kb-categorypg">';
			if ( have_posts() ) {
				while(have_posts()) { the_post(); 
				?>
					  <div class="kb-box-single">
						<div class="kb-single blog">
							<div class="entry-header">
								<h5><a href="<?php the_permalink(); ?>">
									 <?php 
										 $org_title = get_the_title(); 
										 echo html_entity_decode($org_title, ENT_QUOTES, "UTF-8");
									 ?>
								</a></h5>
							</div><!-- .entry-header -->
							<div class="entry-meta">
								<?php iconsult__entry_meta(); ?>
							</div>
						</div>
					  </div>
				<?php 
				} 
			
				// page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( '&lt;', 'iconsult' ),
					'next_text'          => esc_html__( '&gt;', 'iconsult' ),
				) );
				// Eof page navigation.
				
			} else {
				 esc_html_e( 'Sorry, no posts were found', 'iconsult' );
			}			
		echo '</div>';	
		
		?> 
        <!--Eof Display Records Related To Category-->
        
        
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