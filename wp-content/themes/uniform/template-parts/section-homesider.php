<?php
/**
 *  This page display contains related to Slider section at home page
 *  
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
?>

<div class="uniform-slider-wrapper" id="homepage-slider">
    <?php
        $slider_category = get_theme_mod( 'slider_category', '' );
        if ( ! empty( $slider_category ) && $slider_category !='0' ) {
            $posts_perpage_value = -1;
            $posts_perpage_value = apply_filters( 'uniform_slider_posts', $posts_perpage_value );
            $posts_order_vlaue = 'DESC';
            $posts_order_vlaue = apply_filters( 'uniform_slider_order', $posts_order_vlaue );
            $slider_args = array(
                'post_type'      => 'post',
                'cat'            => absint( $slider_category ),
                'posts_per_page' => intval( $posts_perpage_value ),
                'order'          => esc_attr( $posts_order_vlaue )
            );
            $slider_query = new WP_Query( $slider_args );
            if ( $slider_query->have_posts() ) {
                echo '<ul class="bx-slider">';
                while ( $slider_query->have_posts() ) {
                    $slider_query->the_post();
                    if ( has_post_thumbnail() ) {
    ?>
                    <li class="slider">
                        <div class="slide-image">
                            <figure><?php the_post_thumbnail( 'full' ); ?></figure>
                        </div>
                        <div class="mt-container">
                            <div class="slider-container">
                                <div class="entry-container-description">
                                    <h3 class="slider-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="slider-content">
                                        <?php
                                            if ( has_excerpt() ) {
                                                the_excerpt();
                                            } else {
                                                the_content();
                                            }
                                        ?>
                                    </div><!-- .slider-content -->
                                    <div class="clearfix"></div>
                                    <a class="atag-button homeslider-read-more-button" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Read More', 'uniform' ); ?></a>
                                </div><!-- .entry-container-description -->
                            </div><!-- .slider-container -->
                        </div><!-- .mt-container -->
                    </li>
    <?php
                    }
                }
                echo '</ul>';
            }
            wp_reset_postdata();
        }
    ?>
</div><!-- .uniform-slider-wrapper -->