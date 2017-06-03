<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Scent
 */

global $theme_scent;

get_header(); ?>

	<section id="blog">
		<div class="container">

			<?php if( !empty($theme_scent['opt-blog-title']) || !empty($theme_scent['opt-blog-subtitle']) ) { ?>
				<div class="page-title">
					<?php if( !empty($theme_scent['opt-blog-title']) ) { ?><h2><?php echo $theme_scent['opt-blog-title']; ?></h2><?php } ?>
					<?php if( !empty($theme_scent['opt-blog-subtitle']) ) { ?><h4><?php echo $theme_scent['opt-blog-subtitle']; ?></h4><?php } ?>
					<div class="divider"><i class="fa fa-book"></i></div>
				</div>
			<?php } ?>

			<div class="row">

				<?php if( $theme_scent['opt-blog-single-layout'] == 2 ) get_sidebar(); ?>

				<div class="col-sm-8">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'single' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</div>

				<?php if( $theme_scent['opt-blog-single-layout'] == 1 ) get_sidebar(); ?>

			</div>

		</div>
	</section>

<?php get_footer(); ?>
