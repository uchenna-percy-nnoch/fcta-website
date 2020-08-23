<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

$theme = iconsult__admin_get_theme_info();
$theme_name = $theme['name'];
?>

<div class="wrap about-wrap">
	<?php iconsult__admin_menu_tabs(); ?>
    <div class="about-description">
        <?php printf(esc_html__('Thank you for choosing %s!', 'iconsult-framework'), $theme_name); ?>
    </div>
    <br>
</div>