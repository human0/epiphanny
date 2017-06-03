<?php

// Pricing Container

if (!function_exists('pricing_table')) {
    function pricing_table($atts, $content = null) {

        $el_class = $output = '';

        extract(shortcode_atts(array(
            'el_class'      => '',
        ), $atts));

        if( !empty($el_class) ) $el_class = ' ' . $el_class;

        $output = '<div class="prices' . $el_class . '">' . wpb_js_remove_wpautop($content) . '</div>';

        return $output;

    }
}

add_shortcode('pricing_table', 'pricing_table');


/* Pricing Column */

if (!function_exists('pricing_column')) {
	function pricing_column($atts, $content = null) {
        $args = array(
            "title"         => "",
            "subtitle"      => "",
            "price"         => "0",
            "currency"      => "$",
            "price_period"  => "per month",
            "link"          => "",
            "target"        => "",
            "button_text"   => "Sign Up",
            "accent"        => "",
            "column"        => "",
            "active"        => ""
        );
	        
		extract(shortcode_atts($args, $atts));
	        
	    $return = $active = ""; 

        if( $accent == 'yes' ) $active = ' active';

        $return .= "<div class='" . $column . "'>";
        $return .= "<ul class='price-table" . $active . "'>";
        $return .= "<li class='price-title'>" . $title . "<span>" . $subtitle . "</span></li>";
        $return .= "<li class='price-number'>" . $currency . $price . "<span>" . $price_period . "</span></li>";
        $return .= "<li class='price-list'>" . wpb_js_remove_wpautop($content) . "</li>";
	    $return .= "<li class='price-button'><a class='btn btn-primary btn-lg' href='$link' target='$target'>" . $button_text . "</a></li>";
	    $return .= "</ul></div>";
	    
	    return $return;
	}
}
add_shortcode('pricing_column', 'pricing_column');