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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				dro_pizza_posted_on();
				dro_pizza_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php dro_pizza_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_excerpt()  ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php dro_pizza_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .col-12 col-md-6 col-lg-4 -->
