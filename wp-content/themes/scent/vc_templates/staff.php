<?php

// Staff Container

if (!function_exists('staff')) {
    function staff($atts, $content = null) {

		$el_class = $output = '';

		extract(shortcode_atts(array(
		    'staff_layout'  => '',
		    'staff_columns' => '',
		    'el_class'      => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;

		if( $staff_layout != 'grid' ) {
			$output = '<div class="staff-carousel owl-carousel' . $el_class . '" data-columns="' . $staff_columns . '">' . wpb_js_remove_wpautop($content) . '</div>';
		} else {
			$output = '<div class="staff-grid staff-columns-' . $staff_columns . $el_class . '">' . wpb_js_remove_wpautop($content) . '</div>';
		}

		return $output;

	}
}

add_shortcode('staff', 'staff');


// Staff Item

if (!function_exists('staff_item')) {
    function staff_item($atts, $content = null) {

    	/* Get theme options */
		global $theme_scent;

		$el_class = $output = $link_open = $link_close = '';

		extract(shortcode_atts(array(
		    'staff_photo'       => '',
		    'staff_name'        => '',
		    'staff_position'    => '',
		    'staff_description' => '',
		    'staff_link'        => '',
		    'staff_column'      => '',
		    'staff_facebook'    => '',
		    'staff_twitter'     => '',
		    'staff_linkedin'    => '',
		    'staff_google'      => '',
		    'staff_flickr'      => '',
		    'staff_pinterest'   => '',
		    'staff_instagram'   => '',
		    'staff_vimeo'       => '',
		    'staff_youtube'     => '',
		    'staff_email'       => '',
		    'el_class'          => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;
		if( !empty($staff_column) ) $staff_column = ' ' . $staff_column;

		$output .= '<div class="item' . $el_class . $staff_column . '"><div>';

		if( !empty($staff_link) ) {
			$link_open = '<a href="' . $staff_link . '">';
			$link_close = '</a>';
		}

		if( !empty($staff_photo) ) {
			$photo = wp_get_attachment_image_src( $staff_photo, array(240,240) );

			if($theme_scent['theme_color'] == 'white') {
				$mask = '<img src="' . get_template_directory_uri() . '/img/mask-light.png" alt="" class="mask img-responsive">';
			} else {
				$mask = '<img src="' . get_template_directory_uri() . '/img/mask.png" alt="" class="mask img-responsive">';
			}

			$output .= '<div class="staff-photo">' . $link_open . '<img src="' . $photo[0] . '" alt="" class="img-responsive">' . $mask . $link_close . '</div>';
		}

		if( !empty($staff_name) ) $output .= '<h5>' . $link_open . $staff_name . $link_close . '</h5>';

		if( !empty($staff_position) ) $output .= '<p>' . $staff_position . '</p>';

		if( !empty($staff_description) ) $output .= '<p>' . $staff_description . '</p>';

		if( !empty($staff_facebook) || !empty($staff_twitter) || !empty($staff_google) || !empty($staff_linkedin) || !empty($staff_flickr) || !empty($staff_pinterest) || !empty($staff_instagram) || !empty($staff_vimeo) || !empty($staff_youtube) ) {
			$output .= '<p>';
				if( !empty($staff_facebook) ) $output .= ' <a href="' . $staff_facebook . '"><i class="fa fa-facebook-square fa-lg"></i></a> ';
				if( !empty($staff_twitter) ) $output .= ' <a href="' . $staff_twitter . '"><i class="fa fa-twitter-square fa-lg"></i></a> ';
				if( !empty($staff_google) ) $output .= ' <a href="' . $staff_google . '"><i class="fa fa-google-plus-square fa-lg"></i></a> ';
				if( !empty($staff_linkedin) ) $output .= ' <a href="' . $staff_linkedin . '"><i class="fa fa-linkedin-square fa-lg"></i></a> ';
				if( !empty($staff_flickr) ) $output .= ' <a href="' . $staff_flickr . '"><i class="fa fa-flickr fa-lg"></i></a> ';
				if( !empty($staff_pinterest) ) $output .= ' <a href="' . $staff_pinterest . '"><i class="fa fa-pinterest-square fa-lg"></i></a> ';
				if( !empty($staff_instagram) ) $output .= ' <a href="' . $staff_instagram . '"><i class="fa fa-instagram fa-lg"></i></a> ';
				if( !empty($staff_vimeo) ) $output .= ' <a href="' . $staff_vimeo . '"><i class="fa fa-vimeo-square fa-lg"></i></a> ';
				if( !empty($staff_youtube) ) $output .= ' <a href="' . $staff_youtube . '"><i class="fa fa-youtube-square fa-lg"></i></a> ';
				if( !empty($staff_email) ) $output .= ' <a href="mailto:' . $staff_email . '"><i class="fa fa-envelope fa-lg"></i></a> ';
			$output .= '</p>';
		}


		$output .= '</div></div>';

		return $output;

	}
}

add_shortcode('staff_item', 'staff_item');