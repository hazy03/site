<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comment_count = get_comments_number();
				if ( 1 === $comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'uniform' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'uniform' ) ),
						number_format_i18n( $comment_count ),
						'<span>' . get_the_title() . '</span>'
					);
				}
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'uniform' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'uniform' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'uniform' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'uniform' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'uniform' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'uniform' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'uniform' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
