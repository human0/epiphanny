<?php 

wp_enqueue_script('google-map-api');

$style = '';

$section_page = get_post( $page->ID );

$css_classes = get_post_class('', $section_page->ID);

$content_color = get_post_meta( $section_page->ID, 'magicreche-content-color', true );
$fullscreen    = get_post_meta( $section_page->ID, 'magicreche-fullscreen', true );
$min_height    = get_post_meta( $section_page->ID, 'magicreche-min-height', true );
$hue_color     = get_post_meta( $section_page->ID, 'magicreche-hue-color', true );
$center_lat    = get_post_meta( $section_page->ID, 'magicreche-map-center-lat', true );
$center_lng    = get_post_meta( $section_page->ID, 'magicreche-map-center-lng', true );
$map_zoom      = get_post_meta( $section_page->ID, 'magicreche-map-zoom', true );
$map_type      = get_post_meta( $section_page->ID, 'magicreche-map-type', true );
$map_marker    = get_post_meta( $section_page->ID, 'magicreche-map-marker', true );
$locations     = get_post_meta( $section_page->ID, 'magicreche-locations', true );

if( empty($content_color) ) $content_color = 'default';
$css_classes[] = 'scheme-' . $content_color;

// fullscreen

if( !empty($min_height) ) {
	$style = ' style="';
	if( !empty( $min_height ) )  $style .= 'min-height:' . $min_height . ';';
	$style .= '"';
}

// hue-color
// center_lat
// center_lng
// map_zoom
// map_type
// map_marker
// locations

$magicreche_overlay = get_post_meta( $section_page->ID, 'magicreche-overlay', true );
$magicreche_overlay_opacity = get_post_meta( $section_page->ID, 'magicreche-overlay-opacity', true );

if( !empty($magicreche_overlay) ) {
	$overlay = '<div class="tint" style="background-color:' . $magicreche_overlay . ';opacity:' . $magicreche_overlay_opacity . '"></div>';
} else {
	$overlay = '';
}

?><section id="<?php echo esc_attr(getMagicrechePageID($section_page->ID)); ?>" class="<?php echo implode(" ", $css_classes); ?>"<?php echo $style; ?>>

	<script type="text/javascript">

		function initialize() {

			// Create an array of styles.
			var styles = [
				{
					stylers: [
						<?php if(!empty($hue_color)) { ?>{ hue: "<?php echo $hue_color; ?>" },<?php } ?>
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
				zoom: <?php echo $map_zoom; ?>,
				center: new google.maps.LatLng(<?php echo $center_lat; ?>, <?php echo $center_lng; ?>),
				mapTypeControlOptions: {
					mapTypeIds: [google.maps.MapTypeId.<?php echo $map_type; ?>, 'map_style']
				}
			}
			var map = new google.maps.Map(document.getElementById('map-canvas-<?php echo $page->ID; ?>'), mapOptions);

			//Associate the styled map with the MapTypeId and set it to display.
			map.mapTypes.set('map_style', styledMap);
			map.setMapTypeId('map_style');

			setMarkers(map, places);
		    infowindow = new google.maps.InfoWindow({
	            content: "loading..."
	        });
		}

		var places = [<?php
			if( !empty($locations) ) { 
				foreach( $locations as $location ) { ?>
					['<?php echo(esc_attr($location['title'])); ?>', <?php echo($location['magicreche-map-lat']); ?>, <?php echo($location['magicreche-map-lng']); ?>, 1, '<?php echo($location['magicreche-location-content']); ?>'], <?php
				}
			} ?>
		];

		function setMarkers(map, locations) {
			<?php if( !empty($map_marker) ) { ?>
			// Add markers to the map
			var image = {
				url: '<?php echo $map_marker; ?>',
				// This marker is 40 pixels wide by 42 pixels tall.
				size: new google.maps.Size(40, 42),
				// The origin for this image is 0,0.
				origin: new google.maps.Point(0,0),
				// The anchor for this image is the base of the pin at 20,42.
				anchor: new google.maps.Point(15, 42)
			};
			<?php } ?>

			for (var i = 0; i < locations.length; i++) {
				var place = locations[i];
				var myLatLng = new google.maps.LatLng(place[1], place[2]);
				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					<?php if( !empty($map_marker) ) { ?>icon: image,<?php } ?>
					title: place[0],
					zIndex: place[3],
					animation: google.maps.Animation.DROP,
					html: place[4]
				});

		        google.maps.event.addListener(marker, "click", function () {
		            infowindow.setContent(this.html);
		            infowindow.open(map, this);
		        });

			}
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>

	<div class="google-map" id="map-canvas-<?php echo $page->ID; ?>"></div>
	<?php echo $overlay; ?>
	<div class="container"><?php

	include(locate_template( 'includes/page-title.php' ));
	
	?></div>
</section>