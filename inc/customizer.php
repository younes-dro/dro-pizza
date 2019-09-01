<?php

/**
 * Dro Pizza Theme Customizer
 *
 * @package Dro_Pizza
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dro_pizza_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'dro_pizza_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'dro_pizza_customize_partial_blogdescription',
        ));
    }
    /**
     * Contact details section
     */
    $wp_customize->add_section('contact_infos', array(
        'title' => esc_html__('Contact infos', 'dro-pizza'),
        'description' => esc_html__('Address and delivery phone numbers', 'dro-pizza'),
        'panel' => '',
        'priority' => 160,
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_setting('adress_infos', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('adress_infos', array(
        'label' => esc_html__('Adress', 'dro-pizza'),
        'type' => 'textarea',
        'section' => 'contact_infos'
    ));
    $wp_customize->add_setting('phone_infos', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('phone_infos', array(
        'label' => esc_html__('Delivery phone numbers', 'dro-pizza'),
        'type' => 'text',
        'section' => 'contact_infos'
    ));    
    
} 

add_action('customize_register', 'dro_pizza_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function dro_pizza_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function dro_pizza_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dro_pizza_customize_preview_js() {
    wp_enqueue_script('dro-pizza-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'dro_pizza_customize_preview_js');
