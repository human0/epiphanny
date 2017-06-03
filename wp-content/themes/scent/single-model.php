<?php

get_header(); ?>

	<section id="content">
		<div class="container">

			<?php get_template_part( 'inc/page-title' ); ?>

			<div class="row">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="col-sm-7 post-thumb large-thumbnail">
							<?php the_post_thumbnail( 'model-full', array( 'class' => "img-responsive" ) ); ?>
						</div>

						<div class="col-sm-5 entry-content profile">

							<?php $properties = get_post_meta( $post->ID, 'scent_model_data_repeat_group', true );

							if( !empty($properties) ) { ?>

								<ul class="profile">

								<?php foreach ( $properties as $value ) { ?>

									<li class="row">
										<div class="col-xs-4 col-lg-3"><strong><?php echo $value['title']; ?></strong></div>
										<div class="col-xs-8 col-lg-9"><?php echo $value['value']; ?></div>
									</li>

								<?php } ?>

								</ul>

							<?php } ?>
							
							<div class="col-xs-12">

								<?php the_content();

								$ids = get_post_meta( get_the_ID(), 'scent_model_photos', true );
								$selected_images = '';

								if( !empty($ids) ) {

									foreach ($ids as $key => $value) {
										$selected_images .= $key . ',';
									}

								}
								
								echo do_shortcode('[gallery columns="3" size="model-gallery" link="file" ids="' . $selected_images . '"]'); ?>

							</div>

						</div>

					<?php endwhile; ?>

					<?php scent_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</div>

		</div>
	</section>

<?php get_footer(); ?>
