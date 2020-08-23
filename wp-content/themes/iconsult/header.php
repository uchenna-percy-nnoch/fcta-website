<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<?php $global_website_presentation = iconsult_website_global_design_control(); ?>

<body <?php body_class($global_website_presentation); ?>>
<?php 
if( isset($global_website_presentation) && $global_website_presentation != '' ) { 
	echo '<div class="theme_box_wrapper">'; 
} 
iconsult__theme_top_header_display(get_the_ID());
?>

<!-- NAVIGATION -->
<nav class="site-header"> <?php iconsult__theme_header_control(); ?> </nav>

<!-- MOBILE MENU -->
<?php $container_call = iconsult_website_global_full_width_design_control(); ?>
<div class="mobile-menu-holder">
<div class="<?php echo esc_html($container_call); ?>">
<?php if ( has_nav_menu( 'primary' ) ) { wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'clearfix',  'walker' => new iconsult__menu_walker() )); 	} ?>
</div></div>

<?php iconsult__header_process(get_the_ID()); ?>