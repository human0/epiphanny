<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Scent
 */

global $theme_scent;

get_header(); ?>

	<section id="blog">
		<div class="container">

			<div class="page-title">
				<h2><?php _e( 'Search Results', 'scent' ); ?></h2>
				<h4><?php echo get_search_query(); ?></h4>
				<div class="divider"><i class="fa fa-search"></i></div>
			</div>

			<div class="row">

				<?php if( $theme_scent['opt-blog-layout'] == 2 ) get_sidebar(); ?>

				<?php if( $theme_scent['opt-blog-layout'] == 2 || $theme_scent['opt-blog-layout'] == 3 ) { ?><div class="col-sm-8"><?php } else { ?><div class="col-sm-12"><?php } ?>

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php scent_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				<?php if( $theme_scent['opt-blog-layout'] == 2 || $theme_scent['opt-blog-layout'] == 3 ) { ?></div><?php } ?>

				<?php if( $theme_scent['opt-blog-layout'] == 3 ) get_sidebar(); ?>

			</div>

		</div>
	</section>

<?php get_footer(); ?>
