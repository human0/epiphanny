<?php

$el_class = '';
extract(shortcode_atts(array(
	'location_name' => '',
	'location_description' => '',
	'location_latitude' => '',
	'location_longitude' => '',
    'el_class' => '',
), $atts));

echo( "['" . $location_name . "'," . $location_latitude . "," . $location_longitude . ",1,'" . $location_description . "']," );