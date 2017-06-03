<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
