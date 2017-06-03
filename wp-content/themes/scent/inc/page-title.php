<?php
$subtitle = get_post_meta( get_the_ID(), 'scent_page-subtitle', true );
$icon = get_post_meta( get_the_ID(), 'scent_page-icon', true );
//if( get_post_meta( $page->ID, 'scent_disable-title', true ) != 'on' ) {
?><div class="page-title">
<?php if( get_post_meta( get_the_ID(), 'scent_disable-title', true ) != 'on' ) { ?>
	<?php the_title( '<h2>', '</h2>' ); ?>
	<?php if( !empty( $subtitle ) ) { ?><h4><?php echo $subtitle; ?></h4><?php } ?>
	<div class="divider"><?php if( !empty( $icon ) ) { ?><i class="fa <?php echo $icon; ?>"></i><?php } ?></div>
	<?php next_post_link( '%link', '<i class="fa fa-angle-double-left"></i>', true, '', 'model_category' ); ?>
	<?php previous_post_link( '%link', '<i class="fa fa-angle-double-right"></i>', true, '', 'model_category' ); ?>

<?php } ?>
</div>
