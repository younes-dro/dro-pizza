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
function dro_pizza_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'dro_pizza_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'dro_pizza_customize_partial_blogdescription',
        ) );
    }
    // Retreive the defaults values
    $defaults = dro_pizza_default_meta_options();
    
    $wp_customize->add_panel( 'dro_pizza_panel', array(
        'title' => esc_html__( 'Dro Pizza Options', 'dro-pizza' ),
        'descritption' => esc_html__( 'Theme Options', 'dro-pizza' )
    ) );
    
    /**
     * Contact details section
     */
    $wp_customize->add_section( 'dro_pizza_contact_infos', array(
        'title' => esc_html__( 'Contact Infos', 'dro-pizza' ),
        'description' => esc_html__( 'Address and delivery phone numbers', 'dro-pizza' ),
        'panel' => 'dro_pizza_panel',
        'priority' => 160,
        'capability' => 'edit_theme_options'
    ) );
    // Adress
    $wp_customize->add_setting( 'dro_pizza_adress_infos', array(
        'type' => 'theme_mod',
        'default' => esc_html__( 'Adress', 'dro-pizza' ),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ) );
    $wp_customize->add_control( 'dro_pizza_adress_infos', array(
        'label' => esc_html__( 'Adress', 'dro-pizza' ),
        'type' => 'textarea',
        'section' => 'dro_pizza_contact_infos'
    ) );
    // Phone
    $wp_customize->add_setting( 'dro_pizza_phone_infos', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ) );
    $wp_customize->add_control( 'dro_pizza_phone_infos', array(
        'label' => esc_html__( 'Delivery phone numbers', 'dro-pizza' ),
        'type' => 'text',
        'section' => 'dro_pizza_contact_infos'
    ) );
    /**
     * Meta options section
     */
    $wp_customize->add_section( 'dro_pizza_meta_settings', array(
        'title' => esc_html__( 'Meta Options', 'dro-pizza' ),
        'description' => esc_html__( 'Show or hide meta content : posted , author, categories, tags and comments', 'dro-pizza' ),
        'panel' => 'dro_pizza_panel',
        'priority' => 160,
        'cabability' => 'edit_theme_options'
    ) );
    // Text Continue reading
    $wp_customize->add_setting( 'dro_pizza_continue_reading_status', array(
        'default' => $defaults['dro_pizza_continue_reading_status'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox',
            )
    );
    $wp_customize->add_control( 'dro_pizza_continue_reading_status', array(
        'label' => esc_html__( 'Display Continue reading', 'dro-pizza' ),
        'section' => 'dro_pizza_meta_settings',
        'type' => 'checkbox',
        'priority' => 100        
    ) );
    // Posted On , Author
    $wp_customize->add_setting( 'dro_pizza_postedon_status', array(
        'default' => $defaults['dro_pizza_postedon_status'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox',
            )
    );
    $wp_customize->add_control( 'dro_pizza_postedon_status', array(
        'label' => esc_html__( 'Posted On , Author ', 'dro-pizza' ),
        'section' => 'dro_pizza_meta_settings',
        'type' => 'checkbox',
        'priority' => 100
            )
    );    
    // Tags 
    $wp_customize->add_setting( 'dro_pizza_tags_status', array(
        'default' => $defaults['dro_pizza_tags_status'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox'
            )
    );
    $wp_customize->add_control( 'dro_pizza_tags_status', array(
        'label' => esc_html__( 'Tags , Categories , Comments', 'dro-pizza' ),
        'section' => 'dro_pizza_meta_settings',
        'type' => 'checkbox',
        'priority' => 100
            )
    );
    // WhatsApp sharing
    $wp_customize->add_setting('dro_pizza_whatsapp_status', array(
        'default' => $defaults['dro_pizza_whatsapp_status'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox'
        )
    );
    $wp_customize->add_control('dro_pizza_whatsapp_status', array(
        'label' => esc_html__('Show WhatsApp share link?', 'dro-pizza'),
        'section' => 'dro_pizza_meta_settings',
        'type' => 'checkbox',
        'priority' => 100        
        )
    );
    /**
     * Footer section
     */
    $wp_customize->add_section( 'dro_pizza_footer_options', array(
        'title' => esc_html__( 'Footer Options', 'dro-pizza' ),
        'description' => esc_html__( 'Customise the footer area', 'dro-pizza' ),
        'panel' => 'dro_pizza_panel',
        'priority' => 160,
        'capability' => 'edit_theme_options'
    ) );
     // Display / Hide logo 
    $wp_customize->add_setting( 'dro_pizza_footer_logo', array(
        'default' => $defaults['dro_pizza_footer_logo'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox'
    ) );
    $wp_customize->add_control( 'dro_pizza_footer_logo', array(
        'label' => esc_html__( 'Display the logo.', 'dro-pizza' ),
        'section' => 'dro_pizza_footer_options',
        'type' => 'checkbox',
        'priority' => 100
    ) );
    // Display / Hide logo
    $wp_customize->add_setting( 'dro_pizza_footer_blogname', array(
        'default' => $defaults['dro_pizza_footer_blogname'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'dro_pizza_sanitize_checkbox'
    ) );
    
    $wp_customize->add_control( 'dro_pizza_footer_blogname', array(
        'label' => esc_html__( 'Display the Blog Name.', 'dro-pizza' ),
        'section' => 'dro_pizza_footer_options',
        'type' => 'checkbox',
        'priority' => 100
    ) );
    // Copyright link
    $wp_customize->add_setting( 'dro_pizza_copyright_link', array(
        'sanitize_callback' => 'esc_url_raw',
        'cabability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'dro_pizza_copyright_link', array(
        'label' => esc_html__( 'Copyright link', 'dro-pizza' ),
        'description' => esc_html__( 'e.g: http://example.com','dro-pizza' ),
        'section' => 'dro_pizza_footer_options',
        'type' => 'url',
        'priority' => 100
    ) );
    // Copyright text
    $wp_customize->add_setting( 'dro_pizza_copyright_text', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ) );
    $wp_customize->add_control( 'dro_pizza_copyright_text', array(
        'label' => esc_html__( 'Copyright text', 'dro-pizza' ),
        'description' =>esc_html__( 'e.g: Proudly powered by WordPress','dro-pizza' ),
        'type' => 'text',
        'section' => 'dro_pizza_footer_options',
        'priority' => 100
    ) );    
    
    
} 

add_action( 'customize_register', 'dro_pizza_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function dro_pizza_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function dro_pizza_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dro_pizza_customize_preview_js() {
    wp_enqueue_script( 'dro-pizza-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true);
}

add_action( 'customize_preview_init', 'dro_pizza_customize_preview_js' );

/**
 * @param bool $checked Whether the checkbox is checked.
 *
 * @return bool Whether the checkbox is checked.
 */
if ( !function_exists( 'dro_pizza_sanitize_checkbox' ) ):

    function dro_pizza_sanitize_checkbox($checked) {
        return ( ( isset($checked) && true === $checked ) ? true : false );
    }

endif;

if ( !function_exists( 'dro_pizza_default_meta_options' ) ):

    function dro_pizza_default_meta_options() {

        $defaults = array();
        $defaults['dro_pizza_continue_reading_status'] = true;
        $defaults['dro_pizza_postedon_status'] = true;
        $defaults['dro_pizza_tags_status'] = true;
        $defaults['dro_pizza_whatsapp_status'] = false;
        $defaults['dro_pizza_footer_logo'] = true;
        $defaults['dro_pizza_footer_blogname'] = false;


        return $defaults;
    }

endif;

/**
 * Get theme option.
 * @param string $key Option key.
 * @return mixed Option value.
 */
if (!function_exists( 'dro_pizza_get_option' ) ) :

    function dro_pizza_get_option( $key ) {

        if ( empty( $key ) ) {

            return;
        }
        $value = '';
        $default = dro_pizza_default_meta_options();
        $default_value = null;
        if ( is_array( $default ) && isset( $default[$key] ) ) {

            $default_value = $default[$key];
        }
        if ( null !== $default_value ) {

            $value = get_theme_mod( $key, $default_value );
        } else {
            $value = get_theme_mod( $key );
        }

        return $value;
    }




endif;
