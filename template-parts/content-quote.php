<?php
/**
 * Template part for displaying posts in the Quote Post Format.
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
        
    </header><!-- .entry-header -->
    <?php 
        if (has_post_thumbnail()) {
            echo '<div class="single-post-thumbnail clear">';
            echo the_post_thumbnail('featured-thumb');
            echo '</div>';
        }
    ?>
    <div class="entry-content">
        <div class="post-format-content">
            <?php the_content(); ?>
        </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <div class="post-format-footer">
        <?php if ( 'post' == get_post_type() ) : ?>
        <div class="entry-meta">
            <?php jasmin_posted_on(); ?>
            <?php 
                if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                    echo '<span class="comments-link"><i class="fas fa-comments"></i> ';
                    comments_popup_link( __( 'Leave a comment', 'jasmin' ), __( '1 Comment', 'jasmin' ), __( '% Comments', 'jasmin' ) );
                    echo '</span>';
                }
                
                edit_post_link( esc_html__( 'Edit', 'jasmin' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' );
            ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
        </div>
        <?php jasmin_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
