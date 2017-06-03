<?php
$post_format = get_post_format();

switch( $post_format ) {
	case 'gallery':
		$icon = 'th';
		break;

	case 'video':
		$icon = 'play';
		break;

	case 'audio':
		$icon = 'volume-up';
		break;

	default:
		$icon = 'picture-o'; 
} ?><div class="image-container"><?php
if(isset($portfolio_layout) && $portfolio_layout == 'single') {
	the_post_thumbnail('portfolio-single-col');
} else {
	the_post_thumbnail('portfolio-multi-col');
}?><a class="hover" href="<?php the_permalink(); ?>"><div class="hover-icons"><span class="view-project"><span class="fa fa-<?php echo $icon; ?> fa-2x"></span></span></div><p><?php the_title(); ?></p></a></div>