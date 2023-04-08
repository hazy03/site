<?php
/**
 * Template Name: Home Page
 *
 * This is the template that display sections in home page.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
        <!-- Section Slider -->
        <section class="uniform-home-section" id="section-slider">
            <?php get_template_part( 'template-parts/section', 'homesider' ); ?>
        </section>
        
		<?php

            // section services
			if ( get_theme_mod( 'service_section_control', 'enable' ) == 'enable' ) {
				get_template_part( 'template-parts/section', 'services' );
			}

            //section call to action
            if ( get_theme_mod( 'call_to_action_option', 'show' ) == 'show' && is_active_sidebar( 'uniform_call_to_action_area' ) ) {
        ?>
                <section class="uniform-home-section" id="section-callaction">
                    <div class="mt-container">
                        <?php dynamic_sidebar( 'uniform_call_to_action_area' ); ?>
                    </div>
                </section>
        <?php
            }
        
            //Section About
            if ( get_theme_mod( 'about_section_control', 'enable' ) == 'enable' ) {
				get_template_part( 'template-parts/section', 'about' );
			}

            //Section Latest Blog
            if ( get_theme_mod( 'blog_section_control', 'enable' ) == 'enable' ) {
				get_template_part( 'template-parts/section', 'blog' );
			}

        ?>
        </main><!-- #main -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>