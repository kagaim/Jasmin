<?php
/**
 * The template for displaying all single posts.
 *
 * @package jasmin
 */

get_header(); ?>

    <div class="container">
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                
                <?php
                    if ( !get_theme_mod('jasmin_author_box') ) {
                        //Author Box
                        if ( is_single() && get_the_author_meta( 'description' ) ) :
                            get_template_part( 'template-parts/author-box' );
                        endif;
                    }
                ?>
             
			     <?php jasmin_post_nav(); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
