<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

/*=====================================================================================================*/
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function uniform_body_classes( $classes ) {
	
	global $post;
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	/**
     * Sidebar option for post/page/archive
     *
     * @since 1.0.0
     */
    if ( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'uniform_page_sidebar', true );
    }

    if ( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'uniform_page_sidebar', true );
    }
     
    if ( is_home() ) {
        $home_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $home_id, 'uniform_page_sidebar', true );
    }
    
    if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $archive_sidebar 		= get_theme_mod( 'uniform_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar 	= get_theme_mod( 'uniform_default_single_posts_sidebar', 'right_sidebar' );        
    $page_default_sidebar 	= get_theme_mod( 'uniform_default_page_sidebar', 'right_sidebar' );
    
    if ( $sidebar_meta_option == 'default_sidebar' ) {
        if ( is_single() ) {
            if ( $post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif ( $post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif ( $post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar-fullwidth';
            } elseif ( $post_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif ( is_page() && !is_page_template( 'templates/home-template.php' ) ) {
            if ( $page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif ( $page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif ( $page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar-fullwidth';
            } elseif ( $page_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif ( $archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif ( $archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif ( $archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar-fullwidth';
        } elseif ( $archive_sidebar == 'no_sidebar_center' ) {
            $classes[] = 'no-sidebar-center';
        }
    } elseif ( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif ( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif ( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar-fullwidth';
    } elseif ( $sidebar_meta_option == 'no_sidebar_center' ) {
        $classes[] = 'no-sidebar-center';
    }	

	if ( get_theme_mod( 'site_layout_option', 'wide_layout' ) == 'wide_layout' ) {
    		$classes[] = 'fullwidth-layout';
	}
	elseif ( get_theme_mod( 'site_layout_option', 'wide_layout' ) == 'boxed_layout' ) {
		$classes[] = 'boxed-layout';
	}

	return $classes;
}
add_filter( 'body_class', 'uniform_body_classes' );

/*=====================================================================================================*/
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :

	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function uniform_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'uniform' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'uniform_wp_title', 10, 2 );

endif;

/*=====================================================================================================*/
/**
 * Add filter in wp_hed
 */

add_filter( 'wp_head', 'uniform_wp_head' );
 
if ( !function_exists( 'uniform_wp_head' ) ):
    function uniform_wp_head() {
        $homeslider_control = ( get_theme_mod( 'slider_control_option', 'hide' ) == 'show' ) ? 'true' : 'false';
        $homeslider_pager = ( get_theme_mod( 'slider_pager_option', 'show' ) == 'show' ) ? 'true' : 'false';
        $homeslider_transaction = ( get_theme_mod( 'slider_transaction_option', 'auto' ) == 'auto' ) ? 'true' : 'false';
    ?>
        <script type="text/javascript">
                jQuery(function($) {
                    $('#homepage-slider .bx-slider').bxSlider({
                        adaptiveHeight: true,
                        touchEnabled: false,
                        pager: <?php echo esc_attr( $homeslider_pager ); ?>,
                        controls: <?php echo esc_attr( $homeslider_control ); ?>,
                        auto: <?php echo esc_attr( $homeslider_transaction ); ?>
                    });
                    
                    $('.testimonials-slider').bxSlider({
                        adaptiveHeight: true,
                        pager:false,
                    });
                });
        </script>
    <?php
    }
endif;