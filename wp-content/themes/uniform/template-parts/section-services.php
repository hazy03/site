<?php
/**
 *  This page display contains related to service section at home page
 *  
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
?>
<section class="uniform-home-section clearfix" id="section-services">
    <div class="mt-container">
        <div class="uniform-services-wrapper">
            <h2 class="section-title" id="service-section-title"><?php echo esc_html( get_theme_mod( 'service_section_title', __( 'Our Services', 'uniform' ) ) ); ?></h2>
            <?php
                $service_category = get_theme_mod( 'service_category', '0' );
                if ( $service_category != null ) { 
                    $service_post_count = 4;
                    $service_post_count = apply_filters( 'service_posts_count', $service_post_count );

                    $service_more_text = __( 'Read More', 'uniform' );
                    $service_more_text = apply_filters( 'service_more_text', $service_more_text );
            ?>
                <div class="services-wrapper mt-column-wrapper ex-12">
                    <?php
                        $services_args = array(
                            'post_type'      => 'post',
                            'cat'            => absint( $service_category ),
                            'posts_per_page' => intval( $service_post_count )
                        );
                        $services_query = new WP_Query( $services_args );
                        if ( $services_query->have_posts() ) { 
                            while ( $services_query->have_posts() ) {
                                $services_query->the_post();
                                $image_id = get_post_thumbnail_id();
                                $image_path = wp_get_attachment_image_src( $image_id, 'uniform_home_section_thumb', true );
                                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                            <div class="single-service-wrapper mt-column-4">
                                <?php if ( has_post_thumbnail() ){ ?>
                                    <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title_attribute(); ?>" /></figure>
                                <?php } ?>
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-excerpt"><?php the_excerpt(); ?></div>
                                <div class="post-readmore"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $service_more_text ); ?></a> </div>
                            </div><!-- .single-service-wrapper -->
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    ?>
                </div><!-- .services-wrapper -->
            <?php } ?>
        </div><!-- .uniform-services-wrapper -->
    </div><!-- .mt-container -->
</section><!--  #section-services -->