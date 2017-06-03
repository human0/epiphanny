<?php /* Template name: Section: Video */

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

// Video Data

$mp4      = get_post_meta( $section_page->ID, 'scent_video-mp4', true );
$webm     = get_post_meta( $section_page->ID, 'scent_video-webm', true );
$ogv      = get_post_meta( $section_page->ID, 'scent_video-ogv', true );
$loop     = get_post_meta( $section_page->ID, 'scent_video-loop', true );
$autoplay = get_post_meta( $section_page->ID, 'scent_video-autoplay', true );
$poster   = get_post_meta( $section_page->ID, 'scent_preview-image', true );

?><section id="<?php echo esc_attr(scent_getScentPageID($section_page->ID)); ?>" class="<?php echo implode(" ", $css_classes); ?>"<?php echo $section_style; ?>>

	<?php echo $overlay; ?>

	<video<?php if( !empty($poster) ) { ?> poster="<?php echo $poster; ?>"<?php } ?><?php if( $loop == 'yes' ) { ?> loop<?php } ?><?php if( $autoplay == 'yes' ) { ?> autoplay<?php } ?>>
		<?php if( !empty($ogv) ) { ?><source src="<?php echo $ogv; ?>" type="video/ogg"><?php } ?>
		<?php if( !empty($webm) ) { ?><source src="<?php echo $webm; ?>" type="video/webm"><?php } ?>
		<?php if( !empty($mp4) ) { ?><source src="<?php echo $mp4; ?>" type="video/mp4"><?php } ?>
	</video>

	<div class="container">

		<?php if( get_post_meta( $section_page->ID, 'scent_disable-title', true ) != 'on' ) include(locate_template( 'inc/page-title-section.php' )); ?>

		<?php $content = apply_filters('the_content', $page->post_content); ?>

		<?php echo $content; ?>
	
	</div>

</section>


