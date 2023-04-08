<?php
/**
 * Design Settings Panel and respective sections 
 * 
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
 
add_action( 'customize_register', 'uniform_footer_settings_register' );

function uniform_footer_settings_register( $wp_customize ) {

    $wp_customize->add_panel( 
        'uniform_footer_panel', 
        array(
            'priority'       => 6,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Footer', 'uniform' ),
        ) 
    );
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Footer widget area
 */
    $wp_customize->add_section(
        'uniform_footer_widget_section',
        array(
            'title'         => __( 'Footer Widget Area', 'uniform' ),
            'priority'      => 5,
            'panel'         => 'uniform_footer_panel'
        )
    );

    // Footer widget area
    $wp_customize->add_setting(
        'footer_widget_option',
        array(
            'default'           =>'column4',
            'sanitize_callback' => 'uniform_sanitize_footer_widget',
        )
    );
    $wp_customize->add_control(
        'footer_widget_option',
        array(
            'type'          => 'radio',
            'priority'      => 5,
            'label'         => __( 'Choose Widget Option', 'uniform' ),
            'description'   => __( 'Choose option to display number of columns in footer area.', 'uniform' ),
            'section'       => 'uniform_footer_widget_section',
            'choices'       => array(
                'column1'   => __( 'One Column', 'uniform' ),
                'column2'   => __( 'Two Columns', 'uniform' ),
                'column3'   => __( 'Three Columns', 'uniform' ),
                'column4'   => __( 'Four Columns', 'uniform' ),
            ),
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
/**
 * Bottom Footer
 */
    $wp_customize->add_section(
        'uniform_bottom_footer_section',
        array(
            'title'         => __( 'Bottom Footer Section', 'uniform' ),
            'priority'      => 10,
            'panel'         => 'uniform_footer_panel'
        )
    );

    //Copyright text
    $wp_customize->add_setting(
        'uniform_copyright_text', 
        array(
            'default'           => __( '2020 Uniform', 'uniform' ),
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'uniform_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'uniform_copyright_text',
        array(
            'type'        => 'text',
            'label'       => __( 'Copyright Info', 'uniform' ),
            'section'     => 'uniform_bottom_footer_section',
            'priority'    => 5
        )
    );
}