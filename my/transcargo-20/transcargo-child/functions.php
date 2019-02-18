<?php

add_action( 'wp_enqueue_scripts', 'transcargo_child_enqueue_parent_styles' );

function transcargo_child_enqueue_parent_styles() {

	wp_enqueue_style( 'transcargo-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ), TRANSCARGO_THEME_VERSION, 'all' );
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'transcargo-style' ) );

}