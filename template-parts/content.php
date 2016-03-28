<?php
/**
 * Template part for displaying posts.
 *
 * @package jasmin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	    <?php
            // Display a thumb tack in the top right hand corner if this post is sticky
            if (is_sticky()) {
                echo '<i class="fa fa-thumb-tack sticky-post"></i>';
            }
        ?>
        <?php if(!get_theme_mod('jasmin_post_cat')) : ?>
		<?php
            if ( 'post' == get_post_type() ) {
                //* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list( esc_html__( ', ', 'jasmin' ) );
                if ( $categories_list && jasmin_categorized_blog() ) {
                    printf( '<span class="cat-links">' . esc_html__( '%1$s', 'jasmin' ) . '</span>', $categories_list ); // WPCS: XSS OK.
                }
            }
        ?>
        <?php endif; ?>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php jasmin_posted_on(); ?>
			<?php 
                if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                    echo '<span class="comments-link"><i class="fa fa-comments-o"></i> ';
                    comments_popup_link( __( 'Leave a comment', 'jasmin' ), __( '1 Comment', 'jasmin' ), __( '% Comments', 'jasmin' ) );
                    echo '</span>';
                }
                
                edit_post_link( esc_html__( 'Edit', 'jasmin' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' );
            ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
    <?php 
        if (has_post_thumbnail()) {
            echo '<div class="single-post-thumbnail clear">';
            echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'jasmin') . get_the_title() . '" rel="bookmark">';
            echo the_post_thumbnail('featured-thumb');
            echo '</a>';
            echo '</div>';
        }
    ?>
	<div class="entry-content">
        <?php is_single() ? the_content() : the_excerpt() ?>
    </div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php jasmin_entry_footer(); ?>
		
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
