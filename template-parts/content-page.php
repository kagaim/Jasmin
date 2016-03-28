<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package jasmin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    <?php 
        if (has_post_thumbnail()) {
            echo '<div class="single-post-thumbnail clear">';
            echo the_post_thumbnail('featured-thumb');
            echo '</div>';
        }
    ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jasmin' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'jasmin' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' ); ?>
		<?php jasmin_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

