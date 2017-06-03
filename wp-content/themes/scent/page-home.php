<?php /* Template name: Homepage */

get_header();

	// get homepage child pages
	$sections = get_pages( array( 'child_of' => get_the_ID(), 'sort_order' => 'ASC', 'sort_column' => 'menu_order', ) );

	// show sections
	foreach( $sections as $page ) {		

		// get page template
		$page_template = get_page_template_slug( $page->ID );

		if( !empty($page_template) ) {
			include(locate_template( $page_template ));
		} else {
			include(locate_template( 'page-section-default.php' ));
		}

		// show page
		get_template_part( $page_template );

	}

get_footer();