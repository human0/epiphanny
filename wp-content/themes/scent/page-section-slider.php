<?php /* Template name: Section: Slider */

wp_enqueue_script('animate');
wp_enqueue_script('easing');
wp_enqueue_script('superslides');

$section_page = get_post( $page->ID );

$css_classes = get_post_class('template-slider', $section_page->ID);

$section_style = $overlay_style = $overlay = $slider = '';


// Section Data & Overlay

$fullscreen       = get_post_meta( $section_page->ID, 'scent_fullscreen', true );
$overlay          = get_post_meta( $section_page->ID, 'scent_overlay-enable', true );

if( $fullscreen == 'on' ) $css_classes[] = 'fullscreen';

if( $overlay == 'on' ) {

	$overlay_color    = get_post_meta( $section_page->ID, 'scent_overlay-color', true );
	$overlay_image    = get_post_meta( $section_page->ID, 'scent_overlay-image', true );
	$overlay_repeat   = get_post_meta( $section_page->ID, 'scent_overlay-repeat', true );
	$overlay_position = get_post_meta( $section_page->ID, 'scent_overlay-position', true );
	$overlay_opacity  = get_post_meta( $section_page->ID, 'scent_overlay-opacity', true );

		// section data processing
		if( !empty($min_height) ) $section_style .= 'min-height:' . $min_height . 'px;';

		// overlay
		if( !empty($overlay_color) ) $overlay_style .= 'background-color:' . $overlay_color . ';';
		if( !empty($overlay_image) ) $overlay_style .= 'background-image:url(' . $overlay_image . ');background-repeat:' . $overlay_repeat . ';background-position:' . $overlay_position . ';';
		if( !empty($overlay_opacity) ) $overlay_style .= 'opacity:' . $overlay_opacity . ';';

	$overlay = '<div class="tint" style="' . $overlay_style . '"></div>';

}

// Slider Data

$slides = get_post_meta( $section_page->ID, 'scent_slides', true );

$slides_count = count( $slides );

if( !empty($slides) && $slides_count > 1 ) {

	$arrows        = get_post_meta( $section_page->ID, 'scent_slider-arrows', true );
	$pagination    = get_post_meta( $section_page->ID, 'scent_slider-pagination', true );
	$pause         = get_post_meta( $section_page->ID, 'scent_slider-pause', true );
	$animation     = get_post_meta( $section_page->ID, 'scent_slider-effect-speed', true );
	$effect        = get_post_meta( $section_page->ID, 'scent_slider-effect', true );

	$slider .= '<div class="fs-slider" data-width="#' . esc_attr(scent_getScentPageID($section_page->ID)) . '" data-height="#' . esc_attr(scent_getScentPageID($section_page->ID)) . '" data-pagination="' . $pagination . '" data-pause="' . $pause . '" data-animation="' . $animation . '" data-effect="' . $effect . '"><div class="slides-container">';
		foreach( $slides as $slide ) {
			$slider .= '<img src="' . $slide . '" alt="">';
		}
	if( $arrows == 'on' ) {
		$slider .= '</div><nav class="slides-navigation"><a href="#" class="next"><i class="fa fa-angle-right"></i></a><a href="#" class="prev"><i class="fa fa-angle-left"></i></a></nav></div>';
	} else {
		$slider .= '</div></div>';
	}

} else if( $slides_count == 1 ) {
	foreach( $slides as $slide ) { 
		$slider = '<div class="singleslide" style="background-image: url(' . $slide . ');"></div>';
	}
}

?><section id="<?php echo esc_attr(scent_getScentPageID($section_page->ID)); ?>" class="<?php echo implode(" ", $css_classes); ?>"<?php echo $section_style; ?>>

	<?php echo $overlay, $slider; ?>

	<div class="container">

		<?php if( get_post_meta( $section_page->ID, 'scent_disable-title', true ) != 'on' ) include(locate_template( 'inc/page-title-section.php' )); ?>

		<?php $content = apply_filters('the_content', $page->post_content); ?>

		<?php echo $content; ?>
	
	</div>

</section>