<?php /* Template name: Section: Image */

$section_page = get_post( $page->ID );

$css_classes = get_post_class('', $section_page->ID);

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

// Image BG Data

$image_bg = get_post_meta( $section_page->ID, 'scent_bg-image', true );
$opacity  = get_post_meta( $section_page->ID, 'scent_image-bg-opacity', true );
//$parallax = get_post_meta( $section_page->ID, 'scent_parallax', true );
//$velocity = get_post_meta( $section_page->ID, 'scent_velocity', true );
//$fit      = get_post_meta( $section_page->ID, 'scent_fit', true );

?><section id="<?php echo esc_attr(scent_getScentPageID($section_page->ID)); ?>" class="<?php echo implode(" ", $css_classes); ?>"<?php echo $section_style; ?>><?php

	if( !empty($image_bg) ) {
		/*if( $parallax ) { ?>
			<div class="parallax" data-velocity="<?php echo $velocity; ?>" data-fit="<?php echo $fit; ?>" style="background-image: url(<?php echo $image_bg; ?>);opacity:<?php echo $opacity; ?>"></div>
		<?php } else {*/ ?>
			<div class="image-bg" style="background-image: url(<?php echo $image_bg; ?>);opacity:<?php echo $opacity; ?>"></div>		
		<?php /*}*/
	}

	echo $overlay; ?>

	<div class="container">

		<?php if( get_post_meta( $section_page->ID, 'scent_disable-title', true ) != 'on' ) include(locate_template( 'inc/page-title-section.php' )); ?>

		<?php $content = apply_filters('the_content', $page->post_content); ?>

		<?php echo $content; ?>
	
	</div>

</section>


