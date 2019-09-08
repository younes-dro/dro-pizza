<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dro_Pizza
 */

get_header();
?>
<?php
    if(dro_pizza_sidebar_status( 'sidebar-1' )){
            $col_count = 'col-12 col-xl-9';
        }else{
            $col_count = 'col-lg-12';
        }
?>
<div class="<?php echo $col_count?>">
	<div id="primary" class="content-area">
		<main id="main" class="site-main row justify-content-center">

		<?php if ( have_posts() ) : ?>

			<header class="page-header col-12">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'home' );

			endwhile;

			dro_pizza_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .col- -->
<?php
get_sidebar();
get_footer();
