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
                <?php
                $adress_infos = get_theme_mod('adress_infos');
                $phone_infos = get_theme_mod('phone_infos');
                if (!empty(trim($adress_infos)) || !empty(trim($phone_infos))):
                    ?>
                    <div class = "row justify-content-center top-header">
                        <div class = "p2">
                            <?php if (!empty(trim($adress_infos))): ?>
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                <span><?php echo esc_html($adress_infos); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="p2">
                            <?php if (!empty(trim($phone_infos))): ?>
                                <i class="fas fa-shipping-fast" aria-hidden="true"></i>
                                <a href="" class="phone"><?php echo esc_html($phone_infos); ?></a>
                            <?php endif; ?>
                        </div>                    
                    </div>    
                <?php endif; ?>

                <div class="row">
                    <div class="col-12 header-container">
                        <header id="masthead" class="site-header">
                            <svg viewBox="0 0 500 150" preserveAspectRatio="none" >
                            <path 
                                d="M79,74.27 C216.83,192.92 307.3,8.39 500.00,109.03 L500.00,0.00 L0.00,0.00 ZM79,74.27 C216.83,192.92 307.3,8.39 500.00,109.03 L500.00,0.00 L0.00,0.00 Z"
                                style="stroke: none;fill: #000;">

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

                            <?php
                            $headerImage = get_header_image();
//                            echo $headerImage;
                            ?>

                            <div class="site-branding" style="background-image: url(<?php echo $headerImage ?>)">
                                <?php
                                the_custom_logo();
//                                echo '<pre>';
//                                var_dump(get_bloginfo('name'));
//                                echo '</pre>';
                                if (get_bloginfo('name') || is_customize_preview()) :
                                    ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                    <?php
                                endif;
                                $dro_pizza_description = get_bloginfo('description', 'display');
                                if ($dro_pizza_description || is_customize_preview()) :
                                    ?>
                                    <div class="site-description-container">
                                        <p class="site-description"><?php echo $dro_pizza_description; /* WPCS: xss ok. */ ?></p>
                                    </div>
                                <?php endif; ?>
                            </div><!-- .site-branding -->

                        </header><!-- #masthead -->
                    </div><!-- .col-12 -->
                </div><!-- .row -->

                <div id="content" class="site-content">
