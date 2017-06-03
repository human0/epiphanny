<?php

// Models Gallery

if (!function_exists('models_gallery')) {

    function models_gallery($atts, $content = null) {

        // Change slugs here for models:
        $post_type = 'model';
        $post_category = 'model_category';
        $post_tag = 'model_tag';

        $output = $el_class = '';

        extract(shortcode_atts(array(
            'per_page' => -1,
            'pagination' => 0,
            'filtering' => 1,
            'columns' => 6,
            'include_categories' => '',
            'include_tags' => '',
            'names' => 'visible',
            'selected_posts' => '',
            'grayscale' => 1,
            'order' => 'title',
            'sort_order' => 'ASC',
            'grayscale' => 1,
            'el_class' => '',
                        ), $atts));


        if ($grayscale) {
            $grayscale = ' grayscale';
        } else {
            $grayscale = '';
        }

        if ($names == 'hover') {
            $names_class = ' names-hover';
        } else {
            $names_class = '';
        }

        // Query models posts
        global $wp_query;
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;
        $args = array(
            "post_type" => $post_type,
            "posts_per_page" => $per_page,
            "post_status" => "publish",
            "orderby" => $order,
            "order" => $sort_order,
            "paged" => $paged,
        );

        if (!empty($include_categories)) {

            $include_categories = explode(",", $include_categories);

            if (!$pagination) {
                $field = 'name';
            } else {
                $field = 'id';
            }

            $args['tax_query'] = array(
                array(
                    'taxonomy' => $post_category,
                    'field' => $field,
                    'terms' => $include_categories,
                ),
            );
        }

        if (!empty($selected_posts)) {
            $selected_posts = explode(",", $selected_posts);
            $args['post__in'] = $selected_posts;
        }

        // Run query
        $models_query = new WP_Query($args);

        // Filter
        if ($filtering == 1) {

            $model_filters = get_terms($post_tag);

            if (!empty($include_tags)) {
                $include_tags = explode(",", $include_tags);
            }

            if ($model_filters):

                $output .= '<ul class="filter-menu"><li class="filter btn btn-default active" data-filter="mix">' . __("All", "scent") . '</li>';
                foreach ($model_filters as $model_filter):

                    if (!empty($include_tags)) {
                        if (in_array($model_filter->name, $include_tags)) {
                            $output .= '<li class="filter btn btn-default" data-filter="' . $model_filter->slug . '">' . $model_filter->name . '</li>';
                        }
                    } else {
                        $output .= '<li class="filter btn btn-default" data-filter="' . $model_filter->slug . '">' . $model_filter->name . '</li>';
                    }

                endforeach;
                $output .= '</ul>';
            endif;
        }

        // Start loop
        if ($models_query->have_posts()) :

            $output .= '<ul class="models columns-' . $columns . $grayscale . $names_class . '">';

            while ($models_query->have_posts()) : $models_query->the_post();

                $thumb = get_the_post_thumbnail(get_the_ID(), 'gallery-' . $columns, array('class' => "img-responsive"));

                $title = get_the_title(get_the_ID());

                // Get item tags
                $terms = get_the_terms(get_the_ID(), $post_tag);

                if (has_post_thumbnail()) {

                    $output .= '<li class="mix';
                    if ($terms) : foreach ($terms as $term) {
                            $output .= ' ' . $term->slug;
                        } endif;
                    $output .= '">';

                    if ($names != 'invisible') {
                        $output .= '<a href="' . get_permalink() . '">' . $thumb . '<span>' . $title . '</span></a>';
                    } else {
                        $output .= '<a href="' . get_permalink() . '">' . $thumb . '</a>';
                    }

                    $output .= '</li>';
                }

            endwhile;

            $output .= '</ul>';

        endif;

        $temp_query = $wp_query;
        $wp_query = NULL;
        $wp_query = $models_query;

        if ($pagination) {
            ob_start();
            echo '<div class="col-sm-12">';
            scent_paging_nav();
            echo '</div>';
            $output .= ob_get_contents();
            ob_end_clean();
        }

        $wp_query = NULL;
        $wp_query = $temp_query;

        return $output;
    }

}

add_shortcode('models_gallery', 'models_gallery');
