<?php

// Testimonials

if (!function_exists('testimonials')) {
    function testimonials($atts, $content = null) {

		$el_class = $output = '';

		extract(shortcode_atts(array(
		    'testimonials_layout' => '',
		    'interval' => '5000',
		    'speed' => '800',
		    'el_class' => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;

		if( $testimonials_layout != 'grid' ) {
			$output = '<div class="testimonials-carousel owl-carousel' . $el_class . '" data-interval="' . $interval . '" data-speed="' . $speed . '">' . wpb_js_remove_wpautop($content) . '</div>';
		} else {
			$output = '<div class="testimonials-grid' . $el_class . '">' . wpb_js_remove_wpautop($content) . '</div>';
		}

		return $output;

	}
}

add_shortcode('testimonials', 'testimonials');


// Testimonial Item

if (!function_exists('testimonial_item')) {
    function testimonial_item($atts, $content = null) {

		$el_class = $output = '';

		extract(shortcode_atts(array(
		    'testimonial_text'       => '',
		    'testimonial_signature'  => '',
		    'testimonial_column'     => '',
		    'el_class'               => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;
		if( !empty($testimonial_column) ) $testimonial_column = ' ' . $testimonial_column;

		$output .= '<div class="item' . $el_class . $testimonial_column . '"><div><blockquote>';

		if( !empty($testimonial_text) ) $output .= $testimonial_text;

		if( !empty($testimonial_signature) ) $output .= '<small>' . $testimonial_signature . '</small>';

		$output .= '</blockquote></div></div>';

		return $output;

	}
}

add_shortcode('testimonial_item', 'testimonial_item');