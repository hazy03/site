<?php
/**
 * Design Settings Panel and respective sections 
 * 
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
 
add_action( 'customize_register', 'uniform_design_settings_register' );

function uniform_design_settings_register( $wp_customize ) {

    // Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'Uniform_Customize_Control_Radio_Image' );

    $wp_customize->add_panel( 
        'uniform_design_panel', 
        array(
            'priority'       => 5,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Design Settings', 'uniform' ),
            ) 
    );

    $wp_customize->get_section( 'colors' )->panel = 'uniform_design_panel';
    $wp_customize->get_section( 'colors' )->priority = '5';

/*--------------------------------------------------------------------------------------------------------*/  
    /**
     * Primary theme color
     */
    $wp_customize->add_setting(
        'uniform_theme_color',
        array(
            'default'           => '#a0ce4e',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'uniform_theme_color',
            array(
                'label'         => __( 'Theme color', 'uniform' ),
                'section'       => 'colors',
                'settings'      => 'uniform_theme_color',
                'priority'      => 15
            )
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
    /**
     * Archive Page sidebar
     */
    $wp_customize->add_section(
        'uniform_archive_sidebar_section',
        array(
            'title'         => __( 'Archive Sidebar', 'uniform' ),
            'priority'      => 10,
            'panel'         => 'uniform_design_panel'
        )
    );
   
    /*
     * Archive Default layout
     */
	$wp_customize->add_setting(
        'uniform_archive_sidebar', 
        array(
            'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
    		'sanitize_callback' => 'uniform_sanitize_select'
        )
    );

	$wp_customize->add_control( new Uniform_Customize_Control_Radio_Image(
        $wp_customize, 
        'uniform_archive_sidebar', 
        array(
    		'label'           => __( 'Available layouts', 'uniform' ),
            'description'     => __( 'Select layout for whole site archives, categories, search page etc.', 'uniform' ),
    		'section'         => 'uniform_archive_sidebar_section',
            'priority'        => 5,
    		'choices'         => array(
                    'left_sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'label' => esc_html__( 'No Sidebar Center', 'uniform' ),
                        'url'   => '%s/assets/images/no-sidebar-center.png'
                    )
                )
	        )
        )
    );
    
/*--------------------------------------------------------------------------------------------------------*/
    /**
     * Page sidebar
     */
    $wp_customize->add_section(
        'uniform_page_sidebar_section',
        array(
            'title'         => __( 'Page Sidebar', 'uniform' ),
            'priority'      => 15,
            'panel'         => 'uniform_design_panel'
        )
    );
   
    /*
     * Page Sidebar Layouts
     */
	$wp_customize->add_setting(
        'uniform_default_page_sidebar', 
        array(
    		'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
    		'sanitize_callback' => 'uniform_sanitize_select'
        )
    );

	$wp_customize->add_control( new Uniform_Customize_Control_Radio_Image(
        $wp_customize, 
        'uniform_default_page_sidebar', 
        array(
    		'label'       => __( 'Available layouts', 'uniform' ),
            'description' => __( 'Select layout for all pages unless unique layout is set for specific page.', 'uniform' ),
    		'section'     => 'uniform_page_sidebar_section',
            'priority'    => 5,
    		'choices'     => array(
                    'left_sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'label' => esc_html__( 'No Sidebar Center', 'uniform' ),
                        'url'   => '%s/assets/images/no-sidebar-center.png'
                    )
                )
	        )
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
    /**
     * Post sidebar
     */
    $wp_customize->add_section(
        'uniform_post_sidebar_section',
        array(
            'title'         => __( 'Post Sidebar', 'uniform' ),
            'priority'      => 20,
            'panel'         => 'uniform_design_panel'
        )
    );
   
    /**
     * Post Sidebar Layouts
     */
	$wp_customize->add_setting(
        'uniform_default_single_posts_sidebar', 
        array(
    		'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
    		'sanitize_callback' => 'uniform_sanitize_select'
        )
    );

	$wp_customize->add_control( new Uniform_Customize_Control_Radio_Image(
        $wp_customize, 
        'uniform_default_single_posts_sidebar', 
        array(
    		'label'       => __( 'Available layouts', 'uniform' ),
            'description' => __( 'Select layout for all posts unless unique layout is set for specific page.', 'uniform' ),
    		'section'     => 'uniform_post_sidebar_section',
            'priority'    => 5,
    		'choices'     => array(
                    'left_sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'uniform' ),
                        'url'   => '%s/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'label' => esc_html__( 'No Sidebar Center', 'uniform' ),
                        'url'   => '%s/assets/images/no-sidebar-center.png'
                    )
                )
            )
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
    /**
     * Breadcrumbs 
     */
    $wp_customize->add_section(
        'uniform_bredcrumbs_settings',
        array(
            'title'         => __( 'Breadcrumbs', 'uniform' ),
            'priority'      => 25,
            'panel'         => 'uniform_design_panel'
        )
    );
     
    /**
     * Breadcrumbs option
     */
    $wp_customize->add_setting(
        'breadcrumb_option',
        array(
            'default'       =>'show',
            'sanitize_callback' => 'uniform_show_hide_sanitize',
        )
    );
    
    $wp_customize->add_control( new Uniform_Customize_Switch_Control(
        $wp_customize, 
            'breadcrumb_option', 
            array(
                'type'          => 'switch',
                'priority'      => 5,
                'label'         => __( 'Section Option', 'uniform' ),
                'description'   => __( 'Choose option to show/hide Breadcrumbs.', 'uniform' ),
                'section'       => 'uniform_bredcrumbs_settings',
                'choices'       => array(
                    'show' => __( 'Show', 'uniform' ),
                    'hide' => __( 'Hide', 'uniform' ),
                ),
            )
        )
    );
}