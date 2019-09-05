<?php
/**
 * Dro Pizza functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dro_Pizza
 */

if ( ! function_exists( 'dro_pizza_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dro_pizza_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Dro Pizza, use a find and replace
		 * to change 'dro-pizza' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dro-pizza', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'dro-pizza' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'dro_pizza_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 250,
                        'height'      => 100,
			'flex-width'  => true,
			'flex-height' => true,
		) );
                /**
                 * Add image size for thumbnails in the home , archive pages.
                 */
                add_image_size('thumb-home-page', 300, 300,TRUE);
	}
endif;
add_action( 'after_setup_theme', 'dro_pizza_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dro_pizza_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'dro_pizza_content_width', 640 );
}
add_action( 'after_setup_theme', 'dro_pizza_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dro_pizza_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dro-pizza' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dro-pizza' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dro_pizza_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dro_pizza_scripts() {
        /**
         * CSS
         */
        wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri().'/assets/font-awesome/css/fontawesome.css',array(),'20190825' );
        
        wp_enqueue_style( 'fontawesome-solid', get_stylesheet_directory_uri().'/assets/font-awesome/css/solid.css',array(),'20190825' );
        
        wp_enqueue_style( 'ionicons', get_stylesheet_directory_uri().'/assets/ionicons/css/ionicons.css',array(),'20190825' );
         
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/bootstrap/css/bootstrap.css',array(),'20190825' );

        wp_enqueue_style( 'dro-pizza-style', get_stylesheet_uri() );
	/**
         * Js
         */
        wp_enqueue_script( 'dro-pizza-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20190825', true );

	wp_enqueue_script( 'dro-pizza-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20190825', true );

        wp_enqueue_script( 'dro-sliding-menu', get_template_directory_uri(). '/assets/js/dro-sliding-menu.js', array('jquery'), '20190901',true );
        
        if(dro_pizza_is_active_sidebar( 'sidebar-1' ) ){
            wp_enqueue_script( 'masonry' );
        }
        
        wp_enqueue_script( 'dro-pizza', get_template_directory_uri().'/assets/js/dro-pizza.js', array('jquery'),'20190901',true );
        
        
        
        
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dro_pizza_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

