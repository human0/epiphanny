<?php
/**
 * @package Scent
 */

global $theme_scent;

if( $theme_scent['opt-blog-layout'] == 1 && has_post_thumbnail() ) {
	$column_class = 'col-sm-6';
} else {
	$column_class = 'col-sm-12';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<?php if( has_post_thumbnail() ) { ?>
		<div class="<?php echo $column_class; ?> post-thumb">
			<?php get_template_part( 'inc/thumbnail' ); ?>
		</div>
		<?php } ?>
		<div class="<?php echo $column_class; ?> entry-content">
			<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
			<?php get_template_part( 'inc/post-meta' ); ?>
			<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content('');
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'scent' ),
				'after'  => '</div>',
			) );
			?>
			<div class="post-more"><a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-default"><?php _e('Read more', 'scent'); ?></a></div>
		</div>
	</div>
	<div class="row"><div class="col-md-12"><hr></div></div>
</article>