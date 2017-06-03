<?php

$post_format = get_post_format();

global $theme_scent;


if( 'post' == get_post_type() || ( is_home() && ( $theme_scent['opt-blog-layout'] == 2 || $theme_scent['opt-blog-layout'] == 3 ) ) ) {
	$thumb_size = 'blog-sidebar';
} elseif ( 'portfolio' == get_post_type() ) {
	$thumb_size = 'large';	
} else {
	$thumb_size = 'blog-full';
}

switch( $post_format ) {

	case 'audio':

		$audio_strings = explode( "\n", get_post_meta($post->ID, '_format_audio_embed', true) );

		if( !empty($audio_strings) ) {

			// check is embed or file
			$ext = pathinfo($audio_strings[0], PATHINFO_EXTENSION);

			if( $ext ) {

				$audio_sc_string = '[audio';

				foreach( $audio_strings as $value ) {
					$ext = pathinfo($value, PATHINFO_EXTENSION);
					$audio_sc_string .= " " . trim($ext) . "='" . trim($value) . "'";
				}

				if( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumb_size );
					$poster = '<img src="' . $thumbnail['0'] . '">';
					$audio_sc_string .= "]";
				} else {
					$poster = '';
					$audio_sc_string .= ']';
				}
			
				echo $poster . do_shortcode( $audio_sc_string );

			} else {

				global $wp_embed;
				$audio_sc_string = '[embed width="auto"]' . $audio_strings[0] . '[/embed]';
				$post_embed = $wp_embed->run_shortcode( $audio_sc_string );

				echo '<div class="post-thumb">' . $post_embed . '</div>';
			}

		}

        break;


	case 'video':

		$video_strings = explode( "\n", get_post_meta($post->ID, '_format_video_embed', true) );

		if( !empty($video_strings) ) {

			// check is embed or file
			$ext = pathinfo($video_strings[0], PATHINFO_EXTENSION);

			if( $ext ) {

				$video_sc_string = '[video';

				foreach( $video_strings as $value ) {
					$ext = pathinfo($value, PATHINFO_EXTENSION);
					$video_sc_string .= " " . trim($ext) . "='" . trim($value) . "'";
				}

				if( has_post_thumbnail() ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumb_size );
					$url = $thumbnail['0'];
					$video_sc_string .= " poster='" . $url . "']";
				} else {
					$video_sc_string .= ']';
				}
			
				echo do_shortcode( $video_sc_string );

			} else {

				global $wp_embed;
				$video_sc_string = '[embed width="auto"]' . $video_strings[0] . '[/embed]';
				$post_embed = $wp_embed->run_shortcode( $video_sc_string );

				echo $post_embed;
			}

		}

        break;


	case 'gallery':

		$images = get_post_meta($post->ID, 'scent_gallery-images', true);

		if ( !empty($images) ) {

			$banner_rand = rand();

			?><div id="banner-<?php echo $banner_rand; ?>" class="carousel slide">
				<ol class="carousel-indicators"><?php

					$dot = 0;

					foreach( $images as $image ) {
						?><li data-target="#banner-<?php echo $banner_rand; ?>" data-slide-to="<?php echo $dot; ?>"<?php if( !$dot ) { ?> class="active"<?php } ?>></li><?php
						$dot++;
					}

				?></ol>

				<div class="carousel-inner"><?php

					$slide = 0;

					foreach( $images as $id => $url ) {
						?><div class="item<?php if( !$slide ) { ?> active<?php } ?>"><?php echo wp_get_attachment_image($id, $thumb_size); ?></div><?php
						$slide++;
					}

				?></div>

			<a class="left carousel-control" href="#banner-<?php echo $banner_rand; ?>" data-slide="prev"><i class="fa fa-angle-left"></i></a>
			<a class="right carousel-control" href="#banner-<?php echo $banner_rand; ?>" data-slide="next"><i class="fa fa-angle-right"></i></a>
			</div><?php

		}

        break;


    default:

		if( has_post_thumbnail() ) the_post_thumbnail( $thumb_size );

    	break;

} ?>