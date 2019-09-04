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
    // Retrive the defaults values
    $default = dro_pizza_default_meta_options();
    
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
    /**
     * meta settings section
     */
    $wp_customize->add_section('meta_settings', array(
        'title' => esc_html__('Content meta settings', 'dro-pizza'),
        'description' => esc_html__('Show or hide meta content : posted , author, categories, tags and comments', 'dro-pizza'),
        'panel' => '',
        'priority' => 160,
        'cabability' => 'edit_theme_options'
    ));
    // Posted On , Author
    $wp_customize->add_setting('dro_pizza_postedon_status', array(
        'default' => $default['dro_pizza_postedon_status'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox',
            )
    );
    $wp_customize->add_control('dro_pizza_postedon_status', array(
        'label' => esc_html__('Posted On , Author ', 'dro-pizza'),
        'section' => 'meta_settings',
        'type' => 'checkbox',
        'priority' => 100
            )
    );    
    // Tags 
    $wp_customize->add_setting('dro_pizza_tags_status', array(
        'default' => $default['dro_pizza_tags_status'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox',
            )
    );
    $wp_customize->add_control('dro_pizza_tags_status', array(
        'label' => esc_html__('Tags , Categories , Comments', 'dro-pizza'),
        'section' => 'meta_settings',
        'type' => 'checkbox',
        'priority' => 100
            )
    );
    
    
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

/**
 * @param bool $checked Whether the checkbox is checked.
 *
 * @return bool Whether the checkbox is checked.
 */
if (!function_exists('dro_pizza_sanitize_checkbox')):

    function dro_pizza_sanitize_checkbox($checked) {
        return ( ( isset($checked) && true === $checked ) ? true : false );
    }

endif;

if (!function_exists('dro_pizza_default_meta_options')):

    function dro_pizza_default_meta_options() {

        $defaults = array();
        $defaults['dro_pizza_postedon_status'] = false;
        $defaults['dro_pizza_tags_status'] = false;


        return $defaults;
    }

endif;

/**
 * Get theme option.
 * @param string $key Option key.
 * @return mixed Option value.
 */
if (!function_exists('dro_pizza_get_option')) :

    function dro_pizza_get_option($key) {

        if (empty($key)) {

            return;
        }
        $value = '';
        $default = dro_pizza_default_meta_options();
        $default_value = null;
        if (is_array($default) && isset($default[$key])) {

            $default_value = $default[$key];
        }
        if (null !== $default_value) {

            $value = get_theme_mod($key, $default_value);
        } else {
            $value = get_theme_mod($key);
        }

        return $value;
    }




endif;
