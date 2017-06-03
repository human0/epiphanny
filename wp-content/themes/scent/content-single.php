<?php
/**
 * @package Scent
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php get_template_part( 'inc/post-meta' ); ?>

	<div class="post-thumb">
		<?php get_template_part( 'inc/thumbnail' ); ?>
	</div>

	<div class="entry-content">
		
		<?php the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'scent' ),
			'after'  => '</div>',
		) );
		?>

	</div>

</article>