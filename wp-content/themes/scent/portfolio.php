<?php
/* Template Name: Portfolio */

// Change slugs here for portfolio:
$post_type = 'portfolio'; 
$post_category = 'portfolio_category';
$post_tag = 'portfolio_tag';

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

	?><div class="container"><?php

		get_template_part( 'inc/page-title' );

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				the_content();

				// Get portfolio options
				$per_page = get_post_meta( $post->ID, 'scent_per-page', true );
				$filtering = get_post_meta( $post->ID, 'scent_disable-filter', true );
				$include_categories = get_post_meta( $post->ID, 'scent_taxonomy', true );
				$portfolio_layout = get_post_meta( $post->ID, 'scent_portfolio-columns', true );
				$grayscale = get_post_meta( $post->ID, 'scent_grayscale', true );

				// Get thumbnail size
				if ($portfolio_layout == 'single') {
					$thumb_size = 'portfolio-single-col';
				} else {
					$thumb_size = 'portfolio-multi-col';
				}

				// Grayscale
				if($grayscale) {
					$grayscale = ' grayscale';
				} else {
					$grayscale = '';
				}

				// Query portfolio posts
				global $wp_query;
				$paged = get_query_var("paged") ? get_query_var("paged") : 1;
				$args = array(
					"post_type" 		=> $post_type,
					"posts_per_page" 	=> $per_page,
					"post_status" 		=> "publish",
					"orderby" 			=> "date",
					"order" 			=> "DESC",
					"paged" 			=> $paged,
				);

				if( !empty($include_categories) ) {

					$include_categories = explode(",", $include_categories);

					$args['tax_query'] = array(
						array(
							'taxonomy' => $post_category,
							'field'    => 'id',
							'terms'    => $include_categories,
						),
					);
				}

				// Run query
				$portfolio_query = new WP_Query($args);

				// Filter
				if( !$filtering ) {

					$portfolio_filters = get_terms( $post_tag );

					if( $portfolio_filters ): ?>
						<ul class="filter-menu">
							<li class="filter btn btn-default active" data-filter="mix"><?php _e("All", "scent"); ?></li> <?php
							foreach($portfolio_filters as $portfolio_filter): ?><li class="filter btn btn-default" data-filter="<?php echo $portfolio_filter->slug; ?>"><?php echo $portfolio_filter->name; ?></li> <?php endforeach; ?>
						</ul><?php
					endif;

				}

				// Start loop
				if ( $portfolio_query->have_posts() ) : ?>

					<ul class="portfolio portfolio-<?php echo $portfolio_layout . $grayscale; ?>"><?php

						while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

						// Get item tags
						$terms = get_the_terms( get_the_ID(), $post_tag ); 

						if ( has_post_thumbnail()) { 

							?><li class="mix<?php if($terms) : foreach ($terms as $term) { echo ' ' . $term->slug; } endif; ?>"><?php

								// Check if it is single column template, and then add a column for project details
								if( $portfolio_layout == 'single' ) { ?><div class="row"><div class="col-sm-9"><?php }

									include(locate_template('portfolio-box.php'));

								// Columns with project details
								if( $portfolio_layout == 'single' ) { ?></div><div class="col-sm-3">

									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

									$project_details = get_post_meta( get_the_ID(), 'data_strings', true );

									if ( is_array($project_details) && !empty($project_details[0]) ) {

										foreach( $project_details as $property ) {

											$text = $property['property_text'];

											if( $text ) { ?><span><?php echo $text; ?></span><?php }

										}

									} ?>

								</div></div><?php
								} ?>
							</li><?php

						}

						endwhile; ?>

					</ul><?php

				endif; 

			endwhile;

			$temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $portfolio_query;

			scent_paging_nav();

			$wp_query = NULL;
			$wp_query = $temp_query;

		else :

			get_template_part( 'content', 'none' );

		endif; ?>

	</div>
</section>

<?php get_footer(); ?>