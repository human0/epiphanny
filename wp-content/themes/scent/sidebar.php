<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Scent
 */
?>
<div class="col-sm-4 sidebar"><?php
if ( function_exists('dynamic_sidebar')) {

	if ( is_single() && ( get_post_type() == 'post' ) ) {

		dynamic_sidebar('post');		

	} elseif ( is_home() || is_archive() || is_author() || is_category() || is_tag() || is_search() ) {

		dynamic_sidebar('blog');

	} else {

		dynamic_sidebar('default');

	}
	
}
?></div>