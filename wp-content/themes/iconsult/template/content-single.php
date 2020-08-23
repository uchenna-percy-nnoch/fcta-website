<?php
/**
 * The template part for displaying single posts
 */
 
$iconsult_theme_options = iconsult__theme_option_global();
$format = get_post_format();
$featured_image_status = get_post_meta( $id, '__iconsult_display_featured_image_status', true ); 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blog'); ?>>

	<?php if( $iconsult_theme_options['blog-single-title-layout-type'] == 1 ) { ?>
        <div class="entry-header">
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        </div><!-- .entry-header -->
        
        <div class="entry-meta single">
            <?php iconsult__entry_meta(); ?>
        </div><!-- .entry-meta -->
    <?php } ?>
    
    <?php 
	// DISPLAY SPECIAL POST CONTENT
	if( $format == 'audio' && get_post_meta( get_the_ID(), '__iconsult_post_format_audio', true ) != '' ) {
		echo '<div class="sound-wrapper"><audio class="blog_audio" src="'.get_post_meta( get_the_ID(), '__iconsult_post_format_audio', true ).'" controls="controls">';
		esc_html_e( 'Your browser don\'t support audio player', 'iconsult' );
		echo '</audio></div>';
		
	} else if( $format == 'quote' && get_post_meta( get_the_ID(), '__iconsult_post_format_quote', true ) != '' ) {
		echo '<blockquote>'. get_post_meta( get_the_ID(), '__iconsult_post_format_quote', true ) .'</blockquote>';
		
	} else if( $format == 'link' && get_post_meta( get_the_ID(), '__iconsult_post_format_link', true ) != '' ) {
		echo '<div class="linkformat"><h3><a href="'.get_post_meta( get_the_ID(), '__iconsult_post_format_link', true ).'" target="_blank">'. get_the_title () .'</a></h3></div>';
	}
	?>
    
    <?php if( $featured_image_status != true ) { iconsult__post_thumbnail(); } ?>

	<div class="entry-content">
		<?php
			$format = get_post_format();
			if( $format == 'gallery' ) {
				$post_content = get_the_content();
				preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
				$array_id = explode(",", isset($ids[1]) ? $ids[1] : null );
				$count_array = count($array_id); 
				// Content handle
				$content =  str_replace(  isset($ids[0]) ? $ids[0] : null , "", $post_content);
				$filtered_content = apply_filters( 'the_content', $content);
				if( $count_array >= 1 && $array_id[0] != ''  ) { 
					echo '<div class="blog-flexslider"><ul class="slides">';
					foreach($array_id as $img_id){ 
						echo '<li><a href="'.get_permalink().'">'. wp_get_attachment_image( $img_id, 'full' ).'</a></li>';
					}
					echo '</ul></div>';
				}
				echo do_shortcode($filtered_content);
			} else {
				the_content();
			}
			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'iconsult' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'iconsult' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			
			// TAGS
			the_tags( '<div class="tagcloud clearfix padding-top-bottom-30 singlepg"><h6><i class="fa fa-tags"></i> '.esc_html__( 'Tags:', 'iconsult' ).'</h6>', '', '</div>' );
		?>
	</div><!-- .entry-content -->

</div>

<?php 
if ( '' !== get_the_author_meta( 'description' ) ) {
	get_template_part( 'template/biography' );
}
?>