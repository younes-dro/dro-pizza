<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dro_Pizza
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <div class="container-fluid">
                <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dro-pizza'); ?></a>
                <div class="row">
                    <div class="col-12 header-container">
                        <header id="masthead" class="site-header">
                            <svg viewBox="0 0 500 150" preserveAspectRatio="none" >
                            <path 
                                d="M79,74.27 C216.83,192.92 307.3,8.39 500.00,109.03 L500.00,0.00 L0.00,0.00 ZM79,74.27 C216.83,192.92 307.3,8.39 500.00,109.03 L500.00,0.00 L0.00,0.00 Z"
                                style="stroke: none;fill: #f1f1f1;opacity: .2">

                            </path>
                            </svg>

                            <nav id="site-navigation" class="main-navigation">
                                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'dro-pizza'); ?></button>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'menu-1',
                                    'menu_id' => 'primary-menu',
                                ));
                                ?>
                            </nav><!-- #site-navigation -->

                            <div class="site-branding">
                                <?php
                                the_custom_logo();
                                if (is_front_page() && is_home()) :
                                    ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                    <?php
                                else :
                                    ?>
                                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                                <?php
                                endif;
                                $dro_pizza_description = get_bloginfo('description', 'display');
                                if ($dro_pizza_description || is_customize_preview()) :
                                    ?>
                                    <p class="site-description"><?php echo $dro_pizza_description; /* WPCS: xss ok. */ ?></p>
                                <?php endif; ?>
                            </div><!-- .site-branding -->

                        </header><!-- #masthead -->
                    </div><!-- .col-12 -->
                </div><!-- .row -->

                <div id="content" class="site-content">
