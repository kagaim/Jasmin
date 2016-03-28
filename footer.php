<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package jasmin
 */

?>

	</div><!-- #content -->
    
    </div><!-- #container -->
    
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
		    <?php 
		      if ( !get_theme_mod('jasmin_footer_social') ) {
		          jasmin_social_menu(); 
		       }
		    ?>
    		<div class="site-info">
    			<?php echo get_theme_mod('jasmin_copyright_text'); ?>    		
    		</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
