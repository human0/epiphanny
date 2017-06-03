<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Scent
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

<div id="comments" class="comments-area comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title"><?php comments_number( __('No Comments', 'scent'), __('1 Comment', 'scent'), __('% Comments', 'scent') ); ?></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'scent' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'scent' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'scent' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ul class="comment-list media-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'callback'   => 'scent_comment',
				'max_depth'  => 3
			) );
		?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'scent' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'scent' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'scent' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
	
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	// Custom Fields
	$fields =  array(
		'author'=> '<div class="form-group"><label for="author">' . __('Name *', 'scent') . '</label><input name="author" class="form-control" type="text" placeholder="' . __('John Doe', 'scent') . '" size="30"' . $aria_req . '></div>',
		'email'=> '<div class="form-group"><label for="email">' . __('Email *', 'scent') . '</label><input name="email" class="form-control" type="text" placeholder="' . __('name@domain.com', 'scent') . '" size="30"' . $aria_req . '></div>',
		'website'=> '<div class="form-group"><label for="website">' . __('Website (not required)', 'scent') . '</label><input name="website" class="form-control" type="text" placeholder="' . __('www.domain.com', 'scent') . '" size="30"></div>',
	);

	//Comment Form Args
    $comments_args = array(
		'fields' => $fields,
		'title_reply'=> __('Leave a Comment', 'scent'),
		'comment_field' => '<div class="form-group"><label for="comment">' . __('Message', 'scent') . '</label><textarea id="comment" name="comment" class="form-control" cols="10" rows="6" tabindex="4"' . $aria_req . '></textarea></div>',
		'label_submit' => __('Submit','scent')
	); ?>

	<hr>
	
	<?php comment_form($comments_args); ?>

</div><!-- #comments -->
