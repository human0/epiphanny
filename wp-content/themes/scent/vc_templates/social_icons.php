<?php

// Social Icons

if (!function_exists('social_brand')) {
    function social_brand($atts, $content = null) {

		$el_class = $output = '';

		extract(shortcode_atts(array(    
	    	"behance_url" => '',
	    	"deviantart_url" => '',
	    	"flickr_url" => '',
	    	"reddit_url" => '',
	    	"skype_url" => '',
	    	"stumbleupon_url" => '',
	    	"tumblr_url" => '',
	    	"vimeo_url" => '',
	    	"weibo_url" => '',
	    	"xing_url" => '',
	    	"youtube_url" => '',
	    	"foursquare_url" => '',	   
	    	"google_url" => '',
	    	"linkedin_url" => '',
	    	"dribbble_url" => '',
	    	"facebook_url" => '',
	    	"instagram_url" => '',
	    	"pinterest_url" => '',
	    	"soundcloud_url" => '',
	    	"twitter_url" => '',
	    	"vk_url" => '',
		    'el_class' => '',
		), $atts));

		if( !empty($el_class) ) $el_class = ' ' . $el_class;

		$output .= '<div class="social-icons text-center ' . $el_class . '">';

		if( !empty($facebook_url) ) {
			$output .= '<a href="' . $facebook_url . '" target="_blank"><i class="fa fa-facebook"></i></a>';
		}
		if( !empty($twitter_url) ) {
			$output .= '<a href="' . $twitter_url . '" target="_blank"><i class="fa fa-twitter"></i></a>';
		}
		if( !empty($google_url) ) {
			$output .= '<a href="' . $google_url . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
		}
		if( !empty($linkedin_url) ) {
			$output .= '<a href="' . $linkedin_url . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
		}
		if( !empty($youtube_url) ) {
			$output .= '<a href="' . $youtube_url . '" target="_blank"><i class="fa fa-youtube"></i></a>';
		}
		if( !empty($flickr_url) ) {
			$output .= '<a href="' . $flickr_url . '" target="_blank"><i class="fa fa-flickr"></i></a>';
		}
		if( !empty($behance_url) ) {
			$output .= '<a href="' . $behance_url . '" target="_blank"><i class="fa fa-behance"></i></a>';
		}
		if( !empty($deviantatr_url) ) {
			$output .= '<a href="' . $deviantatr_url . '" target="_blank"><i class="fa fa-deviantatr"></i></a>';
		}
		if( !empty($reddit_url) ) {
			$output .= '<a href="' . $reddit_url . '" target="_blank"><i class="fa fa-reddit"></i></a>';
		}
		if( !empty($skype_url) ) {
			$output .= '<a href="' . $skype_url . '" target="_blank"><i class="fa fa-skype"></i></a>';
		}
		if( !empty($stumbleupon_url) ) {
			$output .= '<a href="' . $stumbleupon_url . '" target="_blank"><i class="fa fa-stumbleupon"></i></a>';
		}
		if( !empty($tumblr_url) ) {
			$output .= '<a href="' . $tumblr_url . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
		}
		if( !empty($vimeo_url) ) {
			$output .= '<a href="' . $vimeo_url . '" target="_blank"><i class="fa fa-vimeo-square"></i></a>';
		}
		if( !empty($weibo_url) ) {
			$output .= '<a href="' . $weibo_url . '" target="_blank"><i class="fa fa-weibo"></i></a>';
		}
		if( !empty($xing_url) ) {
			$output .= '<a href="' . $xing_url . '" target="_blank"><i class="fa fa-xing"></i></a>';
		}
		if( !empty($foursquare_url) ) {
			$output .= '<a href="' . $foursquare_url . '" target="_blank"><i class="fa fa-foursquare"></i></a>';
		}
		if( !empty($dribbble_url) ) {
			$output .= '<a href="' . $dribbble_url . '" target="_blank"><i class="fa fa-dribbble"></i></a>';
		}
		if( !empty($instagram_url) ) {
			$output .= '<a href="' . $instagram_url . '" target="_blank"><i class="fa fa-instagram"></i></a>';
		}
		if( !empty($pinterest_url) ) {
			$output .= '<a href="' . $pinterest_url . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
		}
		if( !empty($soundcloud_url) ) {
			$output .= '<a href="' . $soundcloud_url . '" target="_blank"><i class="fa fa-soundcloud"></i></a>';
		}
		if( !empty($vk_url) ) {
			$output .= '<a href="' . $vk_url . '" target="_blank"><i class="fa fa-vk"></i></a>';
		}

		$output .= '</div>';

		return $output;

	}
}

add_shortcode('social_brand', 'social_brand');