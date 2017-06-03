<?php

$subtitle = get_post_meta( $section_page->ID, 'scent_page-subtitle', true );
$icon = get_post_meta( $section_page->ID, 'scent_page-icon', true );

?>
<div class="page-title">
	<h2><?php echo $page->post_title; ?></h2>
	<?php if( !empty( $subtitle ) ) { ?><h4><?php echo $subtitle; ?></h4><?php } ?>
	<div class="divider"><?php if( !empty( $icon ) ) { ?><i class="fa <?php echo $icon; ?>"></i><?php } ?></div>
</div>