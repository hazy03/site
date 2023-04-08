<?php
/**
 * Custom function defines 
 * 
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
/*------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 */
add_action( 'admin_enqueue_scripts', 'uniform_admin_scripts' );

function uniform_admin_scripts( $hook ) {

    global $uniform_theme_version;

    if ( 'widgets.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script( 'jquery-ui-button' );
    
    wp_enqueue_script( 'uniform-admin-script', get_template_directory_uri() .'/assets/js/admin-scripts.js', array( 'jquery' ), esc_attr( $uniform_theme_version ), true );

    wp_enqueue_style( 'uniform-admin-style', get_template_directory_uri() . '/assets/css/admin-styles.css', array(), esc_attr( $uniform_theme_version ) );
}

/*=====================================================================================================*/ 

if ( !function_exists( 'uniform_scripts' ) ) :

    /**
     * Enqueue scripts and styles.
     */
    function uniform_scripts() {

        global $uniform_theme_version;
        
        $query_args = array(
            'family' => 'Open+Sans:400,400italic,300italic,300,600,600italic',
        );
        
        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );

        wp_enqueue_style( 'uniform-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
        
        wp_enqueue_style( 'uniform-style', get_stylesheet_uri() );
        
        wp_enqueue_style( 'uniform-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

    	wp_enqueue_script( 'bxSlider', get_template_directory_uri() . '/assets/library/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );
        
        wp_enqueue_script( 'uniform-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $uniform_theme_version ), true );

    	wp_enqueue_script( 'uniform-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );
        
        if ( get_theme_mod( 'sticky_menu_option', 0 ) == 1 ) {
              wp_enqueue_script( 'sticky-menu', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.js', array( 'jquery' ), '20150309', true );
        
              wp_enqueue_script( 'uniform-sticky-menu-setting', get_template_directory_uri() . '/assets/library/sticky/sticky-setting.js', array( 'sticky-menu' ), '20150309', true );
        }

        wp_enqueue_script( 'uniform-custom-scripts', get_template_directory_uri() . '/assets/js/custom-scripts.js', array( 'jquery' ), esc_attr( $uniform_theme_version ), true );	
        
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    		wp_enqueue_script( 'comment-reply' );
    	}        
    }

endif;
add_action( 'wp_enqueue_scripts', 'uniform_scripts' );

/*=====================================================================================================*/

if ( ! function_exists( 'uniform_sidebar_select' ) ) :

    /**
     * Function to select the sidebar ( modified )
     *
     * @since 1.2.9
     */
    function uniform_sidebar_select() {
        global $post;

        if ( 'post' === get_post_type() ) {
            $sidebar_meta_option = get_post_meta( $post->ID, 'uniform_page_sidebar', true );
        }

        if ( 'page' === get_post_type() ) {
            $sidebar_meta_option = get_post_meta( $post->ID, 'uniform_page_sidebar', true );
        }
         
        if ( is_home() ) {
            $set_id = get_option( 'page_for_posts' );
            $sidebar_meta_option = get_post_meta( $set_id, 'uniform_page_sidebar', true );
        }
        
        if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
            $sidebar_meta_option = 'default_sidebar';
        }
        
        $archive_sidebar = get_theme_mod( 'uniform_archive_sidebar', 'right_sidebar' );
        $post_default_sidebar = get_theme_mod( 'uniform_default_single_posts_sidebar', 'right_sidebar' );
        $page_default_sidebar = get_theme_mod( 'uniform_default_page_sidebar', 'right_sidebar' );
        
        if ( $sidebar_meta_option == 'default_sidebar' ) {
            if ( is_single() ) {
                if ( $post_default_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } elseif ( $post_default_sidebar == 'left_sidebar' ) {
                    get_sidebar( 'left' );
                }
            } elseif ( is_page() ) {
                if ( $page_default_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } elseif ( $page_default_sidebar == 'left_sidebar' ) {
                    get_sidebar( 'left' );
                }
            } elseif ( $archive_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif ( $archive_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif ( $sidebar_meta_option == 'right_sidebar' ) {
            get_sidebar();
        } elseif ( $sidebar_meta_option == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }    	
    }

endif;

/*=====================================================================================================*/

if ( ! function_exists( 'uniform_top_header' ) ) :

    /**
     * Top Header
     */
    function uniform_top_header() {
        $header_show_option = get_theme_mod( 'top_header_option', '0' );
        if ( $header_show_option != '1' ) {
            $top_email  = get_theme_mod( 'top_header_email', 'info@example.com' );
            $top_phone  = get_theme_mod( 'top_header_phone', '+167-157-5987' );
            $top_fb     = get_theme_mod( 'social_fb_link', 'https://facebook.com/' );
            $top_tw     = get_theme_mod( 'social_tw_link', 'https://twitter.com/' );
            $top_gp     = get_theme_mod( 'social_gp_link', 'https://plus.google.com/' );
            $top_lnk    = get_theme_mod( 'social_lnk_link', 'https://linkedin.com/' );
            $top_yt     = get_theme_mod( 'social_yt_link', 'https://youtube.com/' );
            $top_vm     = get_theme_mod( 'social_vm_link', 'https://vimeo.com/' );
            $top_pin    = get_theme_mod( 'social_pin_link', 'https://www.pinterest.com/' );
            $top_insta  = get_theme_mod( 'social_insta_link', 'https://www.instagram.com/' );
        ?>
            <div class="top-header-wrapper clearfix">
                <div class="mt-container">
                    <div class="left-section">
                        <?php if ( !empty( $top_email ) ) { ?><span class="cnt-info mt-mail"><a href="<?php echo esc_url( 'mailto:' . sanitize_email( $top_email ) ); ?>"><i class="fa fa-envelope"></i><?php echo esc_html( $top_email ); ?></a></span><?php } ?>
                        <?php if ( !empty( $top_phone ) ) { ?><span class="cnt-info mt-phone"><a href="<?php echo esc_url( 'tel:'.  esc_attr( $top_phone ) ); ?>"><i class="fa fa-phone"></i><?php echo esc_html( $top_phone ); ?></a></span><?php } ?>
                    </div>
                    <div class="right-section">
                        <?php if ( !empty( $top_fb ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_fb ); ?>" target="_blank"><i class="fa  fa-facebook"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_tw ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_tw ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_gp ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_gp ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_lnk ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_lnk ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_yt ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_yt ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_vm ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_vm ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_pin ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_pin ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></span><?php } ?>
                        <?php if ( !empty( $top_insta ) ) { ?><span class="social-link"><a href="<?php echo esc_url( $top_insta ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></span><?php } ?>
                    </div><!-- .right-section -->
                </div><!-- .mt-container -->
            </div><!-- .top-header-wrapper -->
        <?php
        }
    }

endif;

add_action( 'uniform_before_header', 'uniform_top_header', 10 );


/*=====================================================================================================*/

if ( ! function_exists( 'uniform_excerpt_more' ) ) :

    /**
     * Custom Excerpt type 
     */
    function uniform_excerpt_more( $excerpt ) {
        return '...';
    }

endif;
add_filter( 'excerpt_more', 'uniform_excerpt_more' );

/*------------------------------------------------------------------------------------------------*/
/**
 * Get minified css
 *
 * @since 1.2.9
 */
function uniform_css_strip_whitespace( $css ) {
    $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css = preg_replace( $search, $replace, $css );

    $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} "  => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css = str_replace( $search, $replace, $css );

    return trim( $css );
}

/*=====================================================================================================*/

if ( ! function_exists( 'uniform_dynamic_styles' ) ) :

    /**
     * Dynamic style
     *
     * @since 1.2.9
     */
    function uniform_dynamic_styles() {
        $uniform_theme_color = get_theme_mod( 'uniform_theme_color', '#a0ce4e' );

        $custom_css = '';

        $custom_css .= ".navigation .nav-links a:hover, .bttn:hover, .button, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,.edit-link .post-edit-link,.reply .comment-reply-link,.search-form-main .search-submit,.homeslider-read-more-button:hover,#homepage-slider .bx-pager-item a:hover,#homepage-slider .bx-pager-item a.active,.section-title::after,#section-callaction.uniform-home-section,.about-wrapper .post-readmore a,.widget .widget-title::after,.looks-text,#site-navigation .menu-toggle,.sub-toggle,#testimonials-slider .bx-controls-direction .bx-next:hover,#testimonials-slider .bx-controls-direction .bx-prev:hover,#section-callaction .section-button:hover,.about-wrapper .post-readmore a:hover,.widget_search .search-submit,.scrollup,.widget.widget_tag_cloud a:hover{ background:". esc_attr( $uniform_theme_color ) ."}\n";

        $custom_css .= "a,a:hover, a:focus, a:active,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.left-section a:hover,.right-section a:hover,#site-navigation ul li:hover > a,#site-navigation ul li.current-menu-item > a,#site-navigation ul li.current-menu-ancestor > a,.header-search-wrapper .search-main:hover,.slider-title a:hover,.single-service-wrapper .post-title a:hover,#section-about .section-title a:hover,.blog-post-wrapper .blog-title a:hover,.blog-post-wrapper .posted-on a:hover,.blog-post-wrapper .comments-link a:hover,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.site-info a:hover,.mt-footer-widget .widget a:hover,.mt-footer-widget .widget a:hover::before,.mt-footer-widget .widget li:hover::before,.entry-title a:hover,.entry-meta span a:hover,.number-404,.not-found-text,.post-readmore a:hover { color:". esc_attr( $uniform_theme_color ) ."}\n";

        $custom_css .= ".navigation .nav-links a, .bttn, button, input[type='button'], input[type='reset'], input[type='submit'],.navigation .nav-links a:hover, .bttn:hover, .button, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,.comment-list .comment-body,#site-navigation ul.sub-menu,.search-form-main,.homeslider-read-more-button:hover,.services-wrapper .post-readmore > a::after,.post-readmore > a::after,.testimonials-content-wrapper,.number-404,.main-menu-wrapper,#testimonials-slider .bx-controls-direction .bx-next:hover, #testimonials-slider .bx-controls-direction .bx-prev:hover,#section-callaction .section-button:hover,.widget.widget_tag_cloud a:hover{ border-color:". esc_attr( $uniform_theme_color ) ."}\n";
        
        $refine_custom_css = uniform_css_strip_whitespace( $custom_css );

        wp_add_inline_style( 'uniform-style', $refine_custom_css );
    }

endif;

add_action( 'wp_enqueue_scripts', 'uniform_dynamic_styles' );