<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package jasmin
 */

get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php if(get_theme_mod( 'jasmin_full_width_layout') == 'full' ) : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
