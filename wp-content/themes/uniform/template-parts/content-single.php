<?php
/**
 * Template part for displaying single posts.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php uniform_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) { ?>
	            <div class="single-post-image">
	                <figure><?php the_post_thumbnail( 'uniform_single_default' ); ?></figure>
	            </div>
        <?php 
        	}
        	the_content();
        	
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uniform' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <footer class="entry-footer">
        <?php edit_post_link( esc_html__( 'Edit', 'uniform' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
    
</article><!-- #post-## -->