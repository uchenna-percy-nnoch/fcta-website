<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bbp-forum-header">

	<div class="bbp-forum-title">

	<span class="bbp-reply-post-date"><a href="<?php bbp_forum_permalink(); ?>" class="bbp-reply-permalink"><i class="fa fa-link"></i></a><?php printf( __( 'Last updated %s', 'iconsult' ), bbp_get_forum_last_active_time() ); ?></span>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<h3><?php _e( 'Forum: ', 'iconsult' ); ?><a href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></h3>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

	</div><!-- .bbp-forum-title -->

</div><!-- .bbp-forum-header -->

<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<div class="bbp-forum-content">

		<?php do_action( 'bbp_theme_before_forum_content' ); ?>

		<?php bbp_forum_content(); ?>

		<?php do_action( 'bbp_theme_after_forum_content' ); ?>

	</div><!-- .bbp-forum-content -->

</div><!-- #post-<?php bbp_forum_id(); ?> -->
