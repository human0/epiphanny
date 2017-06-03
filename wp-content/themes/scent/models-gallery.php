<?php
/* Template Name: Models Gallery */

// Change slugs here for models:
$post_type = 'model'; 
$post_category = 'model_category';
$post_tag = 'model_tag';

get_header(); ?>

	<section id="content"><?php

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

			<div class="row"><?php

				if ( have_posts() ) :

					while ( have_posts() ) : the_post();

						the_content();

						// Get options
						$per_page = get_post_meta( $post->ID, 'scent_per-page', true );
						$filtering = get_post_meta( $post->ID, 'scent_disable-filter', true );
						$columns = get_post_meta( $post->ID, 'scent_models-gallery-columns', true );
						$order = get_post_meta( $post->ID, 'scent_models-gallery-order', true );
						$order_by = get_post_meta( $post->ID, 'scent_models-gallery-order-by', true );
						$categories = get_post_meta( $post->ID, 'scent_taxonomy', true );
						$tags = get_post_meta( $post->ID, 'scent_taxonomy_tag', true );
						$names = get_post_meta( $post->ID, 'scent_names', true );
						$grayscale = get_post_meta( $post->ID, 'scent_grayscale', true );

						if(!empty($categories)) $categories = implode (",", $categories);

						if( $filtering != 'on' ) $filtering = 1;
echo('[models_gallery per_page="' . $per_page . '" pagination="1" filtering="' . $filtering . '" columns="' . $columns . '" include_categories="' . $categories . '" include_tags="' . $tags . '" names="' . $names . '" grayscale="' . $grayscale . '" order="' . $order_by . '" sort_order="' . $order . '" selected_posts=""]');
						echo do_shortcode('[models_gallery per_page="' . $per_page . '" pagination="1" filtering="' . $filtering . '" columns="' . $columns . '" include_categories="' . $categories . '" include_tags="' . $tags . '" names="' . $names . '" grayscale="' . $grayscale . '" order="' . $order_by . '" sort_order="' . $order . '" selected_posts=""]');

					endwhile;

				else :

					get_template_part( 'content', 'none' );

				endif; ?>

			</div>

		</div>
	</section>

<?php get_footer(); ?>