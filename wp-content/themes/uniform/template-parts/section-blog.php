<?php
/**
 *  This page display contains related to Latest Blog section at home page
 *  
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
?>

<section class="uniform-home-section" id="section-latest-blog">
    <div class="blog-post-wrapper">
        <div class="mt-container">
            <h2 class="section-title" id="blog-section-title"><?php echo esc_html( get_theme_mod( 'latest_blog_title', __( 'Latest News', 'uniform' ) ) ); ?></h2>
            <div class="posts-wrapper mt-column-wrapper clearfix">
                <?php
                    $blog_category      = get_theme_mod( 'latest_blog_category', '' );
                    $blog_post_count    = 3;
                    $blog_post_count    = apply_filters( 'blog_posts_count', $blog_post_count );
                    
                    if ( ! empty( $blog_category ) && $blog_category != '0' ) {
                        $blog_args = array(
                            'post_type'      => 'post',
                            'cat'            => absint( $blog_category ),
                            'posts_per_page' => intval( $blog_post_count )
                        );
                        $blog_query = new WP_Query( $blog_args );
                        if ( $blog_query->have_posts() ) {
                            while ( $blog_query->have_posts() ) {
                                $blog_query->the_post();
                ?>
                            <div class="single-post-wrapper mt-column-3">
                                <?php if ( has_post_thumbnail() ) { ?>
                                <figure>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'uniform_home_section_thumb' ); ?></a>
                                </figure>
                                <?php } ?>
                                <h3 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="blog-meta-wrap">
                                    <?php 
                                        if ( get_theme_mod( 'blog_post_meta_option', 'show' ) == 'show' ) {
                                            uniform_posted_on();
                                        }
                                    ?>
                                </div>
                                <div class="blog-content"><?php the_excerpt(); ?></div>
                                <div class="post-readmore"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'uniform' ); ?></a> </div>
                            </div><!-- .single-post-wrapper -->
                <?php
                            }
                        }
                        wp_reset_postdata();
                    }
                ?>
            </div><!-- .posts-wrapper -->
        </div><!-- .mt-container -->
    </div><!-- .blog-post-wrapper -->
</section> <!-- #section-latest-blog -->