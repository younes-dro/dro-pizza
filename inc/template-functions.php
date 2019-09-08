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
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}

add_filter('body_class', 'dro_pizza_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function dro_pizza_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'dro_pizza_pingback_header');

if ( !function_exists( 'dro_pizza_image_header' ) ){
    /**
     * Return the background image for header
     */
    function dro_pizza_image_header(){
        
        if(is_home() || is_front_page()):
            return get_header_image();
        endif;
        if( is_single() ):
            return get_the_post_thumbnail_url();
        endif;
        
        return FALSE;
    }
}

if ( !function_exists( 'dro_pizza_sidebar_status' ) ) {
    /*
     * Whether a sidebar is in use
     */

    function dro_pizza_sidebar_status($sidebar) {

        if (is_active_sidebar($sidebar)) {

            return TRUE;
        }
    }

}
add_action('after_setup_theme', 'dro_pizza_sidebar_status');

if (!function_exists('dro_piza_get_excerpt')) {

    /**
     * Limit the excerpt by number of characters but do NOT truncate the last word.
     * 
     * @global object $post
     * @param int $limit
     * @param string $source
     * @return string
     */
    function dro_piza_get_excerpt($limit, $source = null) {

        global $post;

        $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();

        $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);


        $excerpt = substr($excerpt, 0, $limit);

        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));

        $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));

        return wp_kses($excerpt, 'post');
    }

}
if (!function_exists('dro_pizza_is_active_sidebar')) {

    /**
     * Check if sidebar is active
     */
    function dro_pizza_is_active_sidebar($index) {
        global $wp_registered_sidebars;
        $widgetcolums = wp_get_sidebars_widgets();
        if ($widgetcolums[$index])
            return true;
        return false;
    }

}
/**
 * Remove archive title prefixes.
 *
 * @param  string  $title  The archive title from get_the_archive_title();
 * @return string          The cleaned title.
 */
function dro_pizza_custom_archive_title( $title ) {
	// Remove any HTML, words, digits, and spaces before the title.
	return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
}
add_filter( 'get_the_archive_title', 'dro_pizza_custom_archive_title' );

