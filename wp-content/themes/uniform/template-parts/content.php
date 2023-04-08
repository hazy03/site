<?php
/**
 * Template part for displaying posts.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
wp_reset_postdata();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php uniform_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) { ?>
	            <div class="single-post-image">
	                <figure><?php the_post_thumbnail( 'uniform_single_default' ); ?></figure>
	            </div><!-- .single-post-image -->
        <?php
        	}
			the_excerpt();
		?>
        <div class="post-readmore"><a href="<?php the_permalink(); ?>"> <?php esc_html_e( 'Read More', 'uniform' ); ?> </a> </div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uniform' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->