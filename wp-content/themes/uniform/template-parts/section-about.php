<?php
/**
 *  This page display contains related to testimonials and about us section at home page
 *  
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
?>
<section class="uniform-home-section" id="section-about">
    <div class="about-section-wrapper">
        <div class="mt-container">
            <div class="mt-column-wrapper clearfix">
                <?php $section_side = get_theme_mod( 'flip_about_section_switch', 'left' ); ?>
                <div class="about-wrapper mt-column-2 <?php echo esc_attr( $section_side ); ?>">
                    <?php 
                        $page_id = get_theme_mod( 'about_page_left', '0' ) ;
                        if ( ! empty( $page_id ) && $page_id != '0' ) {
                            $page_query = new WP_Query( 'page_id='.$page_id );
                            if ( $page_query->have_posts() ) {
                                while ( $page_query->have_posts() ) {
                                    $page_query->the_post();
                    ?>
                                <h2 class="section-title about-us"><?php the_title(); ?></h2>
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <div class="page-thumb">
                                        <figure><?php the_post_thumbnail( 'large' ); ?></figure>
                                    </div>
                                <?php } ?>
                                <div class="page-content"><?php the_excerpt(); ?></div>
                                <div class="post-readmore"><a href="<?php the_permalink(); ?>"> <?php esc_html_e( 'Read More', 'uniform' ); ?></a></div>
                    <?php
                                }
                            }
                        }
                        wp_reset_postdata();
                    ?>
                </div>
                <div class="testimonials-wrapper mt-column-2">
                    <h2 class="testi-title" id="testi-section-title"><?php echo esc_html( get_theme_mod( 'testimonials_section_title', 'Testimonials' ) ); ?></h2>
                    <div class="testimonials-content-wrapper" id="testimonials-slider">
                        <?php 
                            $testi_category = get_theme_mod( 'testimonials_category', '' );
                            $testi_post_count = 10;
                            $testi_post_count = apply_filters( 'testimonials_posts_count', $testi_post_count );

                            if ( !empty( $testi_category ) && $testi_category != '0' ) {
                                $testi_args = array(
                                    'post_type'      => 'post',
                                    'cat'            => absint( $testi_category ),
                                    'posts_per_page' => intval( $testi_post_count )
                                );
                                $testi_query = new WP_Query( $testi_args );
                                if ( $testi_query->have_posts() ) {
                                    echo '<ul class="bx-slider">';
                                    while ( $testi_query->have_posts() ) {
                                        $testi_query->the_post();
                        ?>
                                    <li class="single-testi-wrapper clearfix">
                                        <div class="author-thumb">
                                            <?php if ( has_post_thumbnail() ) { ?>
                                                <figure><?php the_post_thumbnail( 'thumbnail' ); ?></figure>
                                            <?php } ?>
                                        </div>
                                        <div class="testi-content-wrapper">
                                            <div class="testi-content clearfix"><?php the_content(); ?></div>
                                            <div class="author-name"><?php the_title(); ?></div>
                                        </div>
                                    </li>
                        <?php
                                    }
                                    echo '</ul>';
                                }
                                wp_reset_postdata();
                            }
                        ?>
                    </div><!-- .testimonials-content-wrapper -->
                </div><!-- .testimonials-wrapper -->
            </div><!-- .mt-column-wrapper -->
        </div><!-- .mt-container -->
    </div><!-- .about-section-wrapper -->
</section><!--  #section-about -->