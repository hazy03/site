<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
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
<?php

    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    }
    
    /*
     * hook - body_open_hook
     *
     * @hooked - uniform_body_open_hook - 5
     */
    do_action( 'body_open_hook' );
?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uniform' ); ?></a>

    <?php
        /**
         * hook - uniform_before_header
         *
         * @hooked - uniform_top_header - 10
         * @since 1.3.6
         */
        do_action( 'uniform_before_header' );
    ?>

	<header id="masthead" class="site-header" role="banner">
        <div class="mt-container">
    		<div class="site-branding">
                <?php 
                    if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
        			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                <?php } ?>
    		</div><!-- .site-branding -->

    		<div class="primary-nav-wrapper clearfix">
                <nav id="site-navigation" class="main-navigation" role="navigation">
        			<div class="menu-toggle hide"><a href="javascript:void(0)"><i class="fa fa-bars"></i></a></div>
        			<div class="main-menu-wrapper">
                        <?php 
                            wp_nav_menu(
                                array( 
                                    'theme_location'    => 'primary',
                                    'menu_id'           => 'primary-menu',
                                    'menu_class'        => 'nav-menu'
                                )
                            );
                        ?>
                    </div><!-- .main-menu-wrapper -->
        		</nav><!-- #site-navigation -->
                <div class="header-search-wrapper">
                    <?php if ( get_theme_mod( 'header_search_option', 0 ) == 1 ) { ?>
                        <span class="search-main"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></span>
                        <div class="search-form-main hide clearfix">
                            <div class="mt-container">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    <?php } ?>    
                </div><!-- .header-search-wrapper -->
            </div><!-- .primary-nav-wrapper -->
        </div><!-- .mt-container -->
	</header><!-- #masthead -->

    <?php
        /**
         * hook - uniform_after_header
         *
         * @since 1.3.6
         */
        do_action( 'uniform_after_header' );
    ?>

	<div id="content" class="site-content">
    <?php
        if ( !is_front_page() ) {
            uniform_breadcrumbs();
        }