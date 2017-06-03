<?php

// Portfolio Gallery

if (!function_exists('portfolio_gallery')) {
    function portfolio_gallery($atts, $content = null) {

		// Change slugs here for portfolio:
		$post_type = 'portfolio'; 
		$post_category = 'portfolio_category';
		$post_tag = 'portfolio_tag';

        $output = $el_class = '';

        extract(shortcode_atts(array(
            'per_page'           => -1,
            'pagination'         => 0,
            'filtering'          => 1,
            'columns'            => 4,
            'include_categories' => '',
            'include_tags'       => '',
            'selected_posts'     => '',
            'grayscale'          => 1,
            'order'              => 'title',
            'sort_order'         => 'DESC',
            'el_class'           => '',
        ), $atts)); 


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
			"orderby" 			=> $order,
			"order" 			=> $sort_order,
			"paged" 			=> $paged,
		);

		if( !empty($include_categories) ) {

			$include_categories = explode(",", $include_categories);

			$args['tax_query'] = array(
				array(
					'taxonomy' => $post_category,
					'field'    => 'name',
					'terms'    => $include_categories,
				),
			);
		}

		if ( !empty($selected_posts) ) {
			$selected_posts = explode(",", $selected_posts);
			$args['post__in'] = $selected_posts;
		}

		// Run query
		$portfolio_query = new WP_Query($args);

		// Filter
		if( $filtering == 1 ) {

			$portfolio_filters = get_terms( $post_tag );

			if( $portfolio_filters ):
				$output .= '<ul class="filter-menu"><li class="filter btn btn-default active" data-filter="mix">' . __("All", "scent") . '</li>';
					foreach($portfolio_filters as $portfolio_filter):
						$output .= '<li class="filter btn btn-default" data-filter="' . $portfolio_filter->slug . '">' . $portfolio_filter->name . '</li>';
					endforeach;
				$output .= '</ul>';
			endif;

		}

		// Start loop
		if ( $portfolio_query->have_posts() ) :

			$output .= '<ul class="portfolio portfolio-' . $columns . $grayscale . '">';

				while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

					// Get item tags
					$terms = get_the_terms( get_the_ID(), $post_tag ); 

					if ( has_post_thumbnail()) {

						$output .= '<li class="mix';
									if($terms) : foreach ($terms as $term) { $output .= ' ' . $term->slug; } endif;
						$output .= '">';

		                ob_start();
		                get_template_part( 'portfolio-box' );
		                $output .= ob_get_contents();
		                ob_end_clean();

						$output .= '</li>';

					}

				endwhile;

			$output .= '</ul>';

		endif;

		$temp_query = $wp_query;
		$wp_query   = NULL;
		$wp_query   = $portfolio_query;

		$wp_query = NULL;
		$wp_query = $temp_query;

		return $output;

	}
}

add_shortcode('portfolio_gallery', 'portfolio_gallery');