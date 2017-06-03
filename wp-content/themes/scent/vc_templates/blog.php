<?php

/* Blog
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('recent_blog')) {
	function recent_blog( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        'layout'  => 'carousel',
	        'posts_limit' => 3,
	        'show_thumbnail' => 1,
	        'columns' => 2
	    ), $atts ) );

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $posts_limit
	    );

	    query_posts($args);

		if( have_posts() ) :

			if( $layout != 'grid' ) {
				$output = '<div class="owl-carousel blog-carousel row-margin autoHeight" data-visible="' . $columns . '">';
			} else {
				$output = '<div class="post-grid row">';

				switch ($columns) {
					case 1:
						$width = 'col-sm-12';
						break;

					case 2:
						$width = 'col-sm-6';
						break;

					case 3:
						$width = 'col-sm-4';
						break;
					
					default:
						$width = 'col-sm-3';
						break;
				}

			}

			while ( have_posts() ) : the_post();

				if( $layout == 'carousel' ) {
					$output .= '<div class="item blog-item">';
				} else {
					$output .= '<div class="blog-item ' . $width . '">';
				}

				$css_class = implode(' ', get_post_class());

                ob_start();
            	if( $show_thumbnail && has_post_thumbnail() ) { ?>
            		<div class="post-thumb col-sm-4"><?php the_post_thumbnail('blog-shortcode'); ?></div><div class="post col-sm-8"><?php
            	 } else { ?>
					<div class="post col-sm-12"><?php
				}
            	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				get_template_part( 'inc/post-meta' );
               	$output .= ob_get_contents();
           		ob_end_clean();

				$output .= '<div class="entry-content"><p>' . get_the_excerpt() . '</p></div>';
				$output .= '<div class="post-more"><a href="' . esc_url( get_permalink() ) . '" class="btn btn-default">' . __('Read more', 'scent') . '</a></div>';

				$output .= '</div></div>';
				
			endwhile;

			$output .= '</div>';
		
		endif;

		wp_reset_query();

	    return $output;

	}

}

add_shortcode('recent_blog', 'recent_blog');