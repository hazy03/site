<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mystery Themes
 * @subpackage Uniform
 * @since 1.0.0
 */

/*=====================================================================================================*/
if ( ! function_exists( 'uniform_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function uniform_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'uniform' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    
    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'uniform' ), __( '1 Comment', 'uniform' ), __( '% Comments', 'uniform' ) );
		echo '</span>';
	}
    
    $categories_list = get_the_category_list( __( ', ', 'uniform' ) );
	if ( $categories_list && uniform_categorized_blog() ) {
		printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'uniform' ) . '</span>', $categories_list );
	}

}
endif;

/*=====================================================================================================*/
if ( ! function_exists( 'uniform_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function uniform_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'uniform' ) );
		if ( $categories_list && uniform_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'uniform' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'uniform' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'uniform' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'uniform' ), esc_html__( '1 Comment', 'uniform' ), esc_html__( '% Comments', 'uniform' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'uniform' ), '<span class="edit-link">', '</span>' );
}
endif;

/*=====================================================================================================*/
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function uniform_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'uniform_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'uniform_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so uniform_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so uniform_categorized_blog should return false.
		return false;
	}
}

/*=====================================================================================================*/
/**
 * Flush out the transients used in uniform_categorized_blog.
 */
function uniform_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'uniform_categories' );
}
add_action( 'edit_category', 'uniform_category_transient_flusher' );
add_action( 'save_post',     'uniform_category_transient_flusher' );