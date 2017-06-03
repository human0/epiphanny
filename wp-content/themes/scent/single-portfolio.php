<?php

get_header(); ?>

	<section id="content">
		<div class="container">

			<?php get_template_part( 'inc/page-title' ); ?>

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="portfolio-thumb-large"><?php get_template_part( 'inc/thumbnail' ); ?></div>

						<div class="project row">
							<div class="col-sm-4">

								<h4><?php _e('Project Details', 'scent'); ?></h4><?php

								$project_details = get_post_meta( get_the_ID(), 'data_strings', true );

								if ( is_array($project_details) && !empty($project_details[0]) ) {

									foreach( $project_details as $property ) {

										$text = $property['property_text'];

										if( $text ) { ?><span><?php echo $text; ?></span><?php }

									}

								} ?>

							</div>
							<div class="col-sm-8">

								<h4><?php _e('Project Description', 'scent'); ?></h4><?php
								
								the_content();

							?></div>
						</div>

						</div>

					<?php endwhile; ?>

					<?php scent_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

		</div>
	</section>

<?php get_footer(); ?>