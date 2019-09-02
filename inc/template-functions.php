<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Dro_Pizza
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dro_pizza_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'dro_pizza_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function dro_pizza_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'dro_pizza_pingback_header' );

if ( !function_exists('dro_pizza_sidebar_status')){
    /*
     * Whether a sidebar is in use
     */
    function dro_pizza_sidebar_status( $sidebar ) {
        
        if(is_active_sidebar( $sidebar )){
            
            return TRUE;
        }
    }
    
}
add_action('after_setup_theme', 'dro_pizza_sidebar_status');
