<?php if( is_single() ) { ?>
	<div class="entry-meta">
		<span class="date"><time datetime="<?php echo date(DATE_W3C); ?>"><?php the_time('F j, Y'); ?></time></span>
		<span class="author"><?php _e('By', 'scent'); ?> <?php the_author(); ?></span>
		<span class="entry-comments"><a href="#comments"> <?php comments_number( __('No Comments', 'scent'), __('1 Comment', 'scent'), __('% Comments', 'scent') ); ?></a></span>
		<?php if( has_category() ) { ?><span class="entry-categories"><?php _e('Posted in', 'scent'); ?> <?php the_category(', '); ?></span><?php } ?>
		<?php if( has_tag() ) { ?><span class="entry-tags"><?php _e('Tags:', 'scent'); ?> <?php the_tags('', ', '); ?></span><?php } ?>
	</div>
<?php } else { ?>
	<div class="entry-meta">
		<span class="date"><time datetime="<?php echo date(DATE_W3C); ?>"><?php the_time('F j, Y'); ?></time></span>
		<span class="author"><?php _e('By', 'scent'); ?> <?php the_author(); ?></span>
	</div>
<?php } ?>
