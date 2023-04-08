<?php
/**
 * Uniform Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uniform_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'uniform_customize_partial_blogname',
    ) );

    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'uniform_customize_partial_blogdescription',
    ) );

    /**
     * Register custom section types.
     *
     * @since 1.3.3
     */
    $wp_customize->register_section_type( 'Uniform_Customize_Section_Upsell' );

    /**
     * Register theme upsell sections.
     *
     * @since 1.3.3
     */
    $wp_customize->add_section( new Uniform_Customize_Section_Upsell(
        $wp_customize,
            'theme_upsell',
            array(
                'title'     => esc_html__( 'Uniform Pro', 'uniform' ),
                'pro_text'  => esc_html__( 'Buy Pro', 'uniform' ),
                'pro_url'   => 'https://mysterythemes.com/wp-themes/uniform-pro/',
                'priority'  => 1,
            )
        )
    );

}
add_action( 'customize_register', 'uniform_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Uniform 1.2.5
 * @see uniform_customize_register()
 *
 * @return void
 */
function uniform_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Uniform 1.2.5
 * @see uniform_customize_register()
 *
 * @return void
 */
function uniform_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uniform_customize_preview_js() {
	wp_enqueue_script( 'uniform_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'uniform_customize_preview_js' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 */
function uniform_customize_backend_scripts() {

    wp_enqueue_style( 'uniform_customizer_style', get_template_directory_uri() . '/assets/css/customizer-styles.css' );

    wp_enqueue_script( 'uniform_customizer_script', get_template_directory_uri() . '/assets/js/customizer-control.js', array( 'jquery', 'customize-controls' ), '20150309', true );
}
add_action( 'customize_controls_enqueue_scripts', 'uniform_customize_backend_scripts', 10 );

/**
 * Load all required files for customizer section
 *
 * @since 1.2.9
 */
require get_template_directory() . '/inc/customizer/uniform-custom-classes.php'; // Custom Classes
require get_template_directory() . '/inc/customizer/uniform-sanitize.php'; //Sanitize

require get_template_directory() . '/inc/customizer/uniform-general.php';   // General Settings
require get_template_directory() . '/inc/customizer/uniform-header.php';    // Header Settings
require get_template_directory() . '/inc/customizer/uniform-homepage.php';  // Home Page Settings
require get_template_directory() . '/inc/customizer/uniform-design.php';    // Design Settings
require get_template_directory() . '/inc/customizer/uniform-footer.php';    // Footer Settings