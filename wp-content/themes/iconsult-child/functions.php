<?php
add_action( 'wp_enqueue_scripts', 'iconsult__child_enqueue_styles' );
function iconsult__child_enqueue_styles() {
    wp_enqueue_style( 'iconsult-style', get_template_directory_uri() . '/style.css' );

}
?>