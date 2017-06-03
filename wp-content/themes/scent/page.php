<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Scent
 */

get_header(); ?>

	<section id="page"><?php

		// Page Data & Overlay

		$overlay = get_post_meta( get_the_ID(), 'scent_overlay-enable', true );

		if( $overlay == 'on' ) {

			$overlay_style = '';

			$overlay_color    = get_post_meta( get_the_ID(), 'scent_overlay-color', true );
			$overlay_image    = get_post_meta( get_the_ID(), 'scent_overlay-image', true );
			$overlay_repeat   = get_post_meta( get_the_ID(), 'scent_overlay-repeat', true );
			$overlay_position = get_post_meta( get_the_ID(), 'scent_overlay-position', true );
			$overlay_opacity  = get_post_meta( get_the_ID(), 'scent_overlay-opacity', true );

			// overlay
			if( !empty($overlay_color) ) $overlay_style .= 'background-color:' . $overlay_color . ';';
			if( !empty($overlay_image) ) $overlay_style .= 'background-image:url(' . $overlay_image . ');background-repeat:' . $overlay_repeat . ';background-position:' . $overlay_position . ';';
			if( !empty($overlay_opacity) ) $overlay_style .= 'opacity:' . $overlay_opacity . ';';

			echo('<div class="tint" style="' . $overlay_style . '"></div>');

		}

		?><div class="container">

			<?php get_template_part( 'inc/page-title' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; ?>

				<?php scent_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</div>
	</section>

<?php get_footer(); ?>