<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package jasmin
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jasmin' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		    <div id="top-header">  
        		<div class="container">
            		<nav id="site-navigation" class="main-navigation" role="navigation">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i> <?php esc_html_e( 'Menu', 'jasmin' ); ?></button>
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav><!-- #site-navigation -->
                    
                    <?php if(!get_theme_mod('jasmin_topbar_search')) : ?>
                    <div id="search-container" class="search-box-wrapper clear">
                        <i class="fa fa-search"></i>
                        <?php get_search_form(); ?>
                    </div> <!-- #search -->
                    <?php endif; ?>
                </div>
            </div>
    		<div class="site-branding">
    		    <div class="container">
    		        <!-- start logo -->
                        <?php if (get_theme_mod( 'jasmin_logo')) : ?>
                            <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url(get_theme_mod('jasmin_logo')); ?>" alt="<?php bloginfo('name'); ?>"></a>
                        <?php else : ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif; ?>
                    <!-- end logo -->        			
        			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
    		    </div><!-- #container -->
    		</div><!-- .site-branding -->
    
	</header><!-- #masthead -->

	<div id="content" class="site-content">
