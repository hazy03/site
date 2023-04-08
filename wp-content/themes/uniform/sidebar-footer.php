<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
 
if ( !is_active_sidebar( 'uniform_footer_sidebar_one' ) &&
	!is_active_sidebar( 'uniform_footer_sidebar_two' ) &&
   !is_active_sidebar( 'uniform_footer_sidebar_three' ) &&
   !is_active_sidebar( 'uniform_footer_sidebar_four' ) ) {
	return;
}
$uniform_footer_layout = get_theme_mod( 'footer_widget_option', 'column4' );
?>
<div class="footer-widgets-wrapper clearfix">
    <div class="mt-container <?php echo esc_attr( $uniform_footer_layout ); ?> ">
	   <div class="footer-widgets-area clearfix">
            <div class="mt-footer-widget-wrapper clearfix">
            	<div class="mt-first-footer-widget mt-footer-widget">
            	<?php dynamic_sidebar( 'uniform_footer_sidebar_one' ); ?>
            	</div><!-- .mt-footer-widget -->
        		<?php if ( $uniform_footer_layout != 'column1' ) { ?>
                    <div class="mt-second-footer-widget mt-footer-widget">
                        <?php dynamic_sidebar( 'uniform_footer_sidebar_two' ); ?>
            		</div><!-- .mt-footer-widget -->
                <?php } ?>
                <?php if ( $uniform_footer_layout == 'column3' || $uniform_footer_layout == 'column4' ) { ?>
                        <div class="mt-third-footer-widget mt-footer-widget">
                            <?php dynamic_sidebar( 'uniform_footer_sidebar_three' ); ?>
                    </div><!-- .mt-footer-widget -->
                <?php } ?>
                <?php if ( $uniform_footer_layout == 'column4' ) { ?>
                        <div class="mt-fourth-footer-widget mt-footer-widget">
                            <?php dynamic_sidebar( 'uniform_footer_sidebar_four' ); ?>
                    </div><!-- .mt-footer-widget -->
                <?php } ?>
            </div><!-- .mt-footer-widget-wrapper -->
		</div><!-- .mt-footer-widget-area -->
	</div><!-- .mt-container -->
</div><!-- .footer-widgets-wrapper -->