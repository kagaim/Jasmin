<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package jasmin
 */

?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
    <header class="entry-header">
        <h1 class="entry-title">
            <?php 
            if ( is_404() ) { _e( 'Page not available', 'jasmin' ); }
            else if ( is_search() ) { printf( __( 'Nothing found for <em>', 'jasmin') . get_search_query() . '</em>' ); }
            else { _e( 'Nothing Found', 'jasmin' );}
            ?>
        </h1>
    </header>

    <div class="entry-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jasmin' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
                        
                <?php elseif ( is_404() ) : ?>
                        
                        <p><?php _e( 'You seem to be lost. To find what you are looking for try a search:', 'jasmin' ); ?></p>
                        
                        <div class="content-none">
                            <?php get_search_form(); ?>
                        </div>
                        
        <?php elseif ( is_search() ) : ?>

            <p><?php _e( 'Nothing matched your search terms. Try searching for something else:', 'jasmin' ); ?></p>
            
            <div class="content-none">
                <?php get_search_form(); ?>
            </div>

        <?php else : ?>

            <p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'jasmin' ); ?></p>
            <div class="content-none">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div><!-- .entry-content -->
</section><!-- .no-results -->
