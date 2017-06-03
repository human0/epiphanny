<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Scent
 */

global $theme_scent;

get_header(); ?>

	<section id="blog">
		<div class="container">

			<div class="page-title">
				<h2><?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'scent' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'scent' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'scent' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'scent' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'scent' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'scent' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'scent' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'scent');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'scent');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'scent' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'scent' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'scent' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'scent' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'scent' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'scent' );

						else :
							_e( 'Archives', 'scent' );

						endif;
					?></h2>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<h4>%s</h4>', $term_description );
					endif;
				?>
				<div class="divider"><i class="fa fa-book"></i></div>
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
