<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

get_header(); ?>
<div class="mt-container">
	<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="error-404 not-found">
            <div class="number-404"><?php esc_html_e( '404', 'uniform' ); ?></div>
            <div class="not-found-text"><?php esc_html_e( 'Page Not found', 'uniform' ); ?></div>
            <div class="looks-text"> <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below.', 'uniform' ); ?> </div>
			</section><!-- .error-404 -->
	</main><!-- #main -->
	</div><!-- #primary -->
    
	<?php uniform_sidebar_select(); ?>
</div><!-- .mt-container -->
<?php get_footer(); ?>