<?php
/**
 * Uniform functions and definitions
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

if ( ! function_exists( 'uniform_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uniform_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Uniform, use a find and replace
	 * to change 'uniform' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'uniform', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'uniform' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Enable site logo
	 * @since Uniform 1.2.5
	 */
	add_theme_support( 'custom-logo', array(
	   'height'      => 50,
	   'width'       => 200,
	   'flex-height' => true,
	   'flex-width' => true
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'uniform_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Crop image in required size
	 */
	add_image_size( 'uniform_single_default', 1040, 450, true );
	add_image_size( 'uniform_home_section_thumb', 300, 200, true );
	
}
endif; // uniform_setup
add_action( 'after_setup_theme', 'uniform_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uniform_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uniform_content_width', 640 );
}
add_action( 'after_setup_theme', 'uniform_content_width', 0 );

/**
 * Set the global variable about theme version
 *
 * @global int $uniform_theme_version
 * @since 1.2.9
 */
function uniform_theme_version_callback() {
	$uniform_theme_info = wp_get_theme();
	$GLOBALS['uniform_theme_version'] = $uniform_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'uniform_theme_version_callback', 0 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load uniform custom function file.
 */
require get_template_directory() . '/inc/uniform-functions.php';

/**
 * Load breadcrumbs file.
 */
require get_template_directory() . '/inc/mt-breadcrumbs.php';

/**
 * Add metabox for sidebar layout
 */
require get_template_directory() . '/inc/metabox/sidebar-metabox.php';

/**
 * Load widget functions.
 */
require get_template_directory() . '/inc/widgets/uniform-widget-functions.php';

/**
 * Load theme settings page
 */
require get_template_directory() . '/inc/theme-settings/mt-theme-settings.php';