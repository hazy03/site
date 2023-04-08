<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
?>

<div id="secondary">
	<?php

        do_action( 'uniform_before_sidebar' );

		if ( is_page_template( 'page-templates/contact.php' ) ) {
			$sidebar = 'uniform_contact_page_sidebar';
		}
		else {
			$sidebar = 'uniform_right_sidebar';
		}

        if ( ! dynamic_sidebar( $sidebar ) ) {
            if ( $sidebar == 'uniform_contact_page_sidebar' ) {
                $sidebar_display = __( 'Contact Page', 'uniform' );
            } else {
                $sidebar_display = __( 'Right', 'uniform' );
            }
            the_widget( 'WP_Widget_Text',
                array(
                    'title'  => __( 'Example Widget', 'uniform' ),
                    'text'   => sprintf( __( 'This is an example widget to show how the %1$s Sidebar looks by default. You can add custom widgets from the %2$s widgets screen %3$s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'uniform' ), $sidebar_display, current_user_can( 'edit_theme_options' ) ? '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
                    'filter' => true,
                ),
                array(
                    'before_widget' => '<aside class="widget widget_text clearfix">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h3 class="widget-title"><span>',
                    'after_title'   => '</span></h3>'
                )
            );

        }

        do_action( 'uniform_after_sidebar' );

    ?>
</div><!-- #secondary -->