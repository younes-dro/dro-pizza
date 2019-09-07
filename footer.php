<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dro_Pizza
 */

        $display_footer_logo = get_theme_mod( 'dro_pizza_footer_logo' );
        $display_footer_blogname = get_theme_mod( 'dro_pizza_footer_blogname' );
        $copyright_link = get_theme_mod( 'dro_pizza_copyright_link' );
        $copyright_text = get_theme_mod( 'dro_pizza_copyright_text' );

?>

	</div><!-- #content / .row -->

	<footer id="colophon" class="site-footer row">
            <?php if($display_footer_blogname): ?>
                <div class="col-12 blog-name-footer">
                    <h3><?php bloginfo( 'blog_name' )?></h3>
                </div>            
            <?php endif;?>
            
            <div class="site-info col-12">
                <?php 
                    if( $display_footer_logo ):
                        the_custom_logo();
                    endif;
                ?>
                <?php 
                if( ! empty( $copyright_link ) && ! empty( $copyright_text )): ?>
                &copy; <a href="<?php echo esc_url( $copyright_link )?>" title="<?php echo esc_attr( $copyright_text )?>">
                    <?php echo esc_html( $copyright_text ) ?>
                    </a>
                <?php elseif ( ! empty( $copyright_link ) ): ?>
                &copy; <a href="<?php echo esc_url( $copyright_link )?>" title="<?php echo esc_attr( $copyright_link ) ?>">
                    <?php echo esc_html( $copyright_link ) ?>
                </a>
                <?php elseif( ! empty( $copyright_text ) ): ?>
               &copy; <?php  echo esc_html( $copyright_text ); ?>
                <?php endif; ?>
            </div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- .container-fluid -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
