<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dro_Pizza
 */
?>
<div class="col-12 col-md-6 col-lg-4">
    <?php
    
    $urlimg = get_the_post_thumbnail_url( get_the_ID(),'thumb-home-page' );
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
        <div class="bg-image" style="background-image:url('<?php echo esc_url( $urlimg )?>')"></div>
        <div class="bg-overlay"></div>
        <header class="entry-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            $dro_pizza_postedon_status  = dro_pizza_get_option('dro_pizza_postedon_status');
            if ('post' === get_post_type() && $dro_pizza_postedon_status) :
                ?>
                <div class="entry-meta">
                    <?php
                    dro_pizza_posted_on();
                    dro_pizza_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <?php // dro_pizza_post_thumbnail();  ?>

        <div class="entry-content">
            <?php            
            echo wp_kses( dro_piza_get_excerpt(100),'post');
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <a href="<?php esc_url(the_permalink())?>" 
               title="<?php esc_attr(the_title())?>" 
               class="continue-reading"><?php esc_html_e('Continue Reading', 'dro-pizza')?>
            </a>
            <?php if ( dro_pizza_get_option('dro_pizza_tags_status') ) :?>
            <span class="open-meta-tags"></span>
            <div class="meta-infos" style="display: none">
                <?php dro_pizza_entry_footer(); ?>
            </div>
            <?php  endif; ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .col-12 col-md-6 col-lg-4 -->
