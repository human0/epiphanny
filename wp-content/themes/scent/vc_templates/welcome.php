<?php
// Welcome Message

if (!function_exists('welcome_block')) {
    function welcome_block($atts, $content = null) {

		$output = $el_class = $top_subtitle = $main_title = $bottom_subtitle = $button_text = $button_link = $button = '';

		extract(shortcode_atts(array(
		    'top_subtitle'      => '',
		    'main_title'        => '',
		    'title_img'         => '',
		    'bottom_subtitle'   => '',
		    'button_text'       => '',
		    'button_link'       => '',
		    'button_style'      => '',
		    'button_size'       => '',
		    'el_class'          => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;

		$output .= '<div class="welcome-container' . $el_class . '"><div class="welcome text-center">';

		if( !empty($button_text) ) {
			$button = '<a href="' . $button_link . '" class="btn ' . $button_style . ' ' . $button_size . '">' . $button_text . '</a>';
		}

		if( !empty($top_subtitle) ) {
			$top_subtitle = '<span>' . $top_subtitle . '</span>';
		}

		if( !empty($main_title) ) {
			$output .= '<h1>' . $top_subtitle . $main_title . '</h1>';
		} elseif ( !empty($title_img) ) {
			$image = wp_get_attachment_image_src( $title_img, 'full' );
			$output .= '<h1>' . $top_subtitle . '<img src="' . $image[0] . '"></h1>';
		}

		if( !empty($bottom_subtitle) ) $output .= '<h3>' . $bottom_subtitle . '</h3>';

		$output .= $button . '</div></div>';

		return $output;

	}
}

add_shortcode('welcome_block', 'welcome_block');