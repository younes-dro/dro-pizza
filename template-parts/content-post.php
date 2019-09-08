<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dro_Pizza
 */

?>
<div class="col-12">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header col-12 col-lg-3">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
                $dro_pizza_postedon_status  = dro_pizza_get_option('dro_pizza_postedon_status');
		if ( 'post' === get_post_type() && $dro_pizza_postedon_status) :
			?>
			<div class="entry-meta">
				<?php
				dro_pizza_posted_on();
				dro_pizza_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
                <?php if ( dro_pizza_get_option('dro_pizza_tags_status') ) :?>
                    <footer class="entry-footer">
                        <span class="open-meta-tags"></span>
                        <div class="meta-infos" style="display: none">
                            <?php dro_pizza_entry_footer(); ?>
                        </div>
                    </footer><!-- .entry-footer -->
                <?php  endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content col-12 col-lg-9">
            <?php dro_pizza_post_thumbnail(); ?>
		<?php the_content()  ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .col-12 -->
