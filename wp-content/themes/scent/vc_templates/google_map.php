<?php

function google_map( $atts, $content = null) {

	extract( shortcode_atts( array(
		'map_hue_color'  => '#ffd200',
		'map_height'  => '500',
		'map_center_latitude'  => '52.2393167',
		'map_center_longitude'  => '21.0214167',
		'map_zoom'  => '18',
		'map_type'  => 'ROADMAP',
		'marker_icon'  => '',
		'el_class'  => ''
	), $atts ) );

	$map_id = 'g-map-' . rand();

	wp_enqueue_script('google-map-api');

	$map_code = '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFE9EC5-jTB_gyb-NcUWwsoQQHZbhoZNQ"
    type="text/javascript"></script>
    <script type="text/javascript">
(function ($) {
    "use strict";
    
    $(document).ready(function () {
		function initialize() {

			// Create an array of styles.
			var styles = [
				{
					stylers: [
						{ hue: "' . $map_hue_color . '" },
						{ saturation: 0 }
					]
				},{
					featureType: "road",
					elementType: "geometry",
					stylers: [
						{ lightness: 100 },
						{ visibility: "simplified" }
					]
				},{
					featureType: "road",
					elementType: "labels",
					stylers: [
						{ visibility: "off" }
					]
				}
			];

			// Create a new StyledMapType object, passing it the array of styles,
			// as well as the name to be displayed on the map type control.
			var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});

			var mapOptions = {
				scrollwheel: false,
				zoom: ' . $map_zoom . ',
				center: new google.maps.LatLng(' . $map_center_latitude . ', ' . $map_center_longitude . '),
				mapTypeControlOptions: {
					mapTypeIds: [google.maps.MapTypeId.' . $map_type . ', "map_style"]
				}
			}
			var map = new google.maps.Map(document.getElementById("' . $map_id . '"), mapOptions);

			//Associate the styled map with the MapTypeId and set it to display.
			map.mapTypes.set("map_style", styledMap);
			map.setMapTypeId("map_style");

			setMarkers(map, places);
		    infowindow = new google.maps.InfoWindow({
	            content: "loading..."
	        });
		}

		var places = [' . wpb_js_remove_wpautop($content) . '];

		function setMarkers(map, markers) {
			// Add markers to the map';

			if( !empty($marker_icon) ) {

				$marker_icon = wp_get_attachment_image_src( $marker_icon, 'full' );

				$map_code .= '

				var image = {
					url: "' . $marker_icon[0] . '",
					// This marker is 40 pixels wide by 42 pixels tall.
					size: new google.maps.Size(40, 42),
					// The origin for this image is 0,0.
					origin: new google.maps.Point(0,0),
					// The anchor for this image is the base of the pin at 20,42.
					anchor: new google.maps.Point(14, 42)
				};';
			}

			$map_code .= '

			for (var i = 0; i < markers.length; i++) {
		        var locations = markers[i];
		        var siteLatLng = new google.maps.LatLng(locations[1], locations[2]);
		        var marker = new google.maps.Marker({
		            position: siteLatLng,
		            map: map,
					';
					if( !empty($marker_icon) ) $map_code .= 'icon: image,';
					$map_code .= '
		            title: locations[0],
		            zIndex: locations[3],
		            html: locations[4]
		        });

		        google.maps.event.addListener(marker, "click", function () {
		            infowindow.setContent(this.html);
		            infowindow.open(map, this);
		        });
			}
		}

		google.maps.event.addDomListener(window, "load", initialize);
		    });

})(jQuery);
	</script><div id="' . $map_id . '" style="height: ' . $map_height . 'px;" class="google-map"></div>';

    return $map_code;
}

add_shortcode('google_map', 'google_map');
