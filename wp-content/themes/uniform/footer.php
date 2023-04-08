<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

?>
	</div><!-- #content -->

	<?php
        /**
         * hook - uniform_before_footer
         *
         * @since 1.3.6
         */
        do_action( 'uniform_before_footer' );
    ?>
    <footer id="colophon" class="site-footer clearfix" role="contentinfo">
        <?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
            <div class="mt-container">
                <?php
                    $uniform_copyright_text = get_theme_mod( 'uniform_copyright_text', __( '2020 Uniform', 'uniform' ) );
                    if ( !empty( $uniform_copyright_text ) ) {
                        echo esc_html( $uniform_copyright_text );
                    } else {
                ?>
                        <span class="copyright-text">&copy; <?php echo esc_html( date('Y') ); ?></span><span class="uniform-sitename"> <?php bloginfo( 'name' ); ?></span>
                <?php
                    }
                ?>
                <span class="sep"> | </span>
    			<?php 
                    $designer_ur = 'https://mysterythemes.com/';
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'uniform' ), 'Uniform', '<a href="'. esc_url( $designer_ur ) .'" rel="designer">Mystery Themes</a>' ); ?>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

    <?php
        /**
         * hook - uniform_after_footer
         *
         * @since 1.3.6
         */
        do_action( 'uniform_after_footer' );
    ?>
    
    <a href="javascript:void(0)" class="scrollup"><i class="fa fa-chevron-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
