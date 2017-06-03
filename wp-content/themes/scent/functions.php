<?php
/**
 * Scent functions and definitions
 *
 * @package Scent
 */

//if ( !defined('WP_CONTENT_URL') )
	//define( 'WP_CONTENT_URL', site_url( 'wp-content') );

/**
 * Bootstrap Nav Walker
 */
require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

if ( ! function_exists( 'scent_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function scent_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Scent, use a find and replace
	 * to change 'scent' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'scent', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size('blog-full', 555, 312, false);
	add_image_size('blog-sidebar', 750, 422, false);
	add_image_size('blog-shortcode', 400, 400, true);

	add_image_size('gallery-2', 570, 570, true);
	add_image_size('gallery-4', 279, 279, true);
	add_image_size('gallery-6', 186, 186, true);

	add_image_size('portfolio-multi-col', 559, 348, true);
	add_image_size('portfolio-single-col', 848, 999, false);

	add_image_size('model-full', 670, 9999, false);

	add_image_size('model-gallery', 137, 137, true);

	add_image_size('featured_preview', 55, 55, true);

	update_option('thumbnail_size_w', 165);
	update_option('thumbnail_size_h', 165);
	update_option('thumbnail_crop', 1);
	update_option('medium_size_w', 375);
	update_option('medium_size_h', 999);
	update_option('large_size_w', 1140);
	update_option('large_size_h', 9999);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'scent' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'image', 'audio' ) );

	// Add Post Formats for Portfolio Post Type
	add_post_type_support( 'portfolio', 'post-formats' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'scent_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // scent_setup
add_action( 'after_setup_theme', 'scent_setup' );


/**
 * Get featured image.
 */
function scent_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

/**
 * Add new column.
 */
function scent_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}

/**
 * Show the featured image.
 */ 
function scent_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = scent_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_posts_columns', 'scent_columns_head');
add_action('manage_posts_custom_column', 'scent_columns_content', 10, 2);


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function scent_widgets_init() {
    register_sidebar(array(
        'name' => 'Default',
        'id' => 'default',
        'description' => 'This sidebar will be used on pages by default, but it can be overriden with custom generated sidebar.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside><hr>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
    register_sidebar(array(
        'name' => 'Blog',
        'id' => 'blog',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside><hr>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
    register_sidebar(array(
        'name' => 'Post',
        'id' => 'post',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside><hr>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
    // Set the default sidebar
	update_option('simple_page_sidebars_default_sidebar', 'default');
}

add_action( 'widgets_init', 'scent_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function scent_scripts() {

	global $theme_scent;

	// CSS
	if($theme_scent['theme_color'] == 'white') {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap-light.min.css' );
		wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme-light.min.css' );
	} else {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
	}

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );

	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );

	wp_enqueue_style( 'superslides', get_template_directory_uri() . '/css/superslides.css' );

	wp_enqueue_style( 'scent-style', get_stylesheet_uri() );

	if( $theme_scent['theme_color'] == 'white' ) {
		wp_enqueue_style( 'scent_white', get_template_directory_uri() . '/css/white.css' );
	}

	$custom_css = trim($theme_scent['custom_css']);
	if( !empty( $custom_css ) ) {
		wp_enqueue_style( 'custom_css', get_template_directory_uri() . '/css/custom.css' );
	}

	wp_enqueue_style('js_composer_front');

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

	/**
	 * WP admin CSS.
	 */
	function cofeecream_admin_style() {
		wp_enqueue_style( 'admin-styles', get_theme_file_uri( '/css/admin.css' ) );
	}

	// JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.97074.js', 'jquery', '1.0', false);

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', '1.0', true);

	wp_enqueue_script('retina', get_template_directory_uri() . '/js/retina-1.1.0.min.js', 'jquery', '1.0', true);

	wp_enqueue_script('owl_carousel', get_template_directory_uri() . '/js/owl.carousel.js', 'jquery', '1.0', true);
	
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', 'jquery', '1.0', true);

	wp_enqueue_script('superslides', get_template_directory_uri() . '/js/jquery.superslides.js', 'jquery', '1.0', true);

	wp_enqueue_script('scrolly', get_template_directory_uri() . '/js/jquery.scrolly.js', 'jquery', '1.0', true);

	wp_enqueue_script('mixitup', get_template_directory_uri() . '/js/jquery.mixitup.min.js', 'jquery', '1.0', true);

	wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0', true);

	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', 'jquery', '1.0', true);

	$custom_js = trim($theme_scent['custom_js']);
	if( !empty( $custom_js ) ) {
		wp_enqueue_script('custom_js', get_template_directory_uri() . '/js/custom.js', 'jquery', '1.0', true);	
	}

}
add_action( 'wp_enqueue_scripts', 'scent_scripts' );

/**
 * Add ie conditional html5 shim to header.
 */
function scent_add_ie_html5_shim() {
	global $is_IE;
	if ($is_IE)	echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
}
add_action('wp_head', 'scent_add_ie_html5_shim');


/* Visual Composer
-------------------------------------------------------------------------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

	function requireVcExtend(){
		require_once get_template_directory() . '/vc_templates/extend-vc.php';
	}
	add_action('init', 'requireVcExtend', 2);

	require_once( get_template_directory() . '/vc_templates/staff.php' );
	require_once( get_template_directory() . '/vc_templates/pricing_table.php' );
	require_once( get_template_directory() . '/vc_templates/models_gallery.php' );
	require_once( get_template_directory() . '/vc_templates/portfolio_gallery.php' );
	require_once( get_template_directory() . '/vc_templates/testimonials.php' );
	require_once( get_template_directory() . '/vc_templates/blog.php' );
	require_once( get_template_directory() . '/vc_templates/welcome.php' );
	require_once( get_template_directory() . '/vc_templates/google_map.php' );
	require_once( get_template_directory() . '/vc_templates/social_icons.php' );

	vc_remove_element("vc_posts_grid");
	vc_remove_element("vc_carousel");
	vc_remove_element("vc_posts_slider");
	vc_remove_element("vc_button");
	vc_remove_element("vc_cta_button");
	vc_remove_element("vc_gmaps");
	vc_remove_element("vc_toggle");

	vc_remove_element("vc_widget_sidebar");
	vc_remove_element("vc_wp_search");
	vc_remove_element("vc_wp_meta");
	vc_remove_element("vc_wp_recentcomments");
	vc_remove_element("vc_wp_calendar");
	vc_remove_element("vc_wp_pages");
	vc_remove_element("vc_wp_tagcloud");
	vc_remove_element("vc_wp_custommenu");
	vc_remove_element("vc_wp_text");
	vc_remove_element("vc_wp_posts");
	vc_remove_element("vc_wp_links");
	vc_remove_element("vc_wp_categories");
	vc_remove_element("vc_wp_archives");
	vc_remove_element("vc_wp_rss");

}

/**
 * Set VC as theme.
 */
function coffeecream_vcSetAsTheme() {
    vc_set_as_theme();
}
add_action( 'vc_before_init', 'coffeecream_vcSetAsTheme' );

/**
 * Model post type, model categories and model tags taxonomy registrations.
 */

/* 1. Model post type */

$post_type = 'model'; 
$post_category = 'model_category';
$post_tag = 'model_tag';

if( !post_type_exists( $post_type ) ) {

	$labels = array(
		'name'               => __( 'Model', 'model-post-type' ),
		'singular_name'      => __( 'Model Item', 'model-post-type' ),
		'add_new'            => __( 'Add New Item', 'model-post-type' ),
		'add_new_item'       => __( 'Add New Model Item', 'model-post-type' ),
		'edit_item'          => __( 'Edit Model Item', 'model-post-type' ),
		'new_item'           => __( 'Add New Model Item', 'model-post-type' ),
		'view_item'          => __( 'View Item', 'model-post-type' ),
		'search_items'       => __( 'Search Model', 'model-post-type' ),
		'not_found'          => __( 'No Model items found', 'model-post-type' ),
		'not_found_in_trash' => __( 'No Model items found in trash', 'model-post-type' ),
	);

	$supports = array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'comments',
		'author',
		'custom-fields',
		'revisions',
	);

	$args = array(
		'labels'          => $labels,
		'supports'        => $supports,
		'public'          => true,
		'capability_type' => 'post',
		'rewrite'         => array( 'slug' => 'model' ), // Change slug here for models
		'menu_position'   => 5,
		'menu_icon'       => 'dashicons-groups',
		'has_archive'     => true,
	);

	register_post_type( $post_type, $args );

	/* 2. Model categories */

	$labels = array(
		'name'                       => __( 'Model Categories', 'model-post-type' ),
		'singular_name'              => __( 'Model Category', 'model-post-type' ),
		'menu_name'                  => __( 'Model Categories', 'model-post-type' ),
		'edit_item'                  => __( 'Edit Model Category', 'model-post-type' ),
		'update_item'                => __( 'Update Model Category', 'model-post-type' ),
		'add_new_item'               => __( 'Add New Model Category', 'model-post-type' ),
		'new_item_name'              => __( 'New Model Category Name', 'model-post-type' ),
		'parent_item'                => __( 'Parent Model Category', 'model-post-type' ),
		'parent_item_colon'          => __( 'Parent Model Category:', 'model-post-type' ),
		'all_items'                  => __( 'All Model Categories', 'model-post-type' ),
		'search_items'               => __( 'Search Model Categories', 'model-post-type' ),
		'popular_items'              => __( 'Popular Model Categories', 'model-post-type' ),
		'separate_items_with_commas' => __( 'Separate model categories with commas', 'model-post-type' ),
		'add_or_remove_items'        => __( 'Add or remove model categories', 'model-post-type' ),
		'choose_from_most_used'      => __( 'Choose from the most used model categories', 'model-post-type' ),
		'not_found'                  => __( 'No model categories found.', 'model-post-type' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => $post_category ),
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( $post_category, $post_type, $args );

	/* 2. Model tags */

	$labels = array(
		'name'                       => __( 'Model Tags', 'model-post-type' ),
		'singular_name'              => __( 'Model Tag', 'model-post-type' ),
		'menu_name'                  => __( 'Model Tags', 'model-post-type' ),
		'edit_item'                  => __( 'Edit Model Tag', 'model-post-type' ),
		'update_item'                => __( 'Update Model Tag', 'model-post-type' ),
		'add_new_item'               => __( 'Add New Model Tag', 'model-post-type' ),
		'new_item_name'              => __( 'New Model Tag Name', 'model-post-type' ),
		'parent_item'                => __( 'Parent Model Tag', 'model-post-type' ),
		'parent_item_colon'          => __( 'Parent Model Tag:', 'model-post-type' ),
		'all_items'                  => __( 'All Model Tags', 'model-post-type' ),
		'search_items'               => __( 'Search Model Tags', 'model-post-type' ),
		'popular_items'              => __( 'Popular Model Tags', 'model-post-type' ),
		'separate_items_with_commas' => __( 'Separate model tags with commas', 'model-post-type' ),
		'add_or_remove_items'        => __( 'Add or remove model tags', 'model-post-type' ),
		'choose_from_most_used'      => __( 'Choose from the most used model tags', 'model-post-type' ),
		'not_found'                  => __( 'No model tags found.', 'model-post-type' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'hierarchical'      => false,
		'rewrite'           => array( 'slug' => $post_tag ),
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( $post_tag, $post_type, $args );

}


/**
 * Portfolio post type, portfolio categories and portfolio tags taxonomy registrations.
 */

/* 1. Portfolio post type */

$post_type = 'portfolio';
$post_category = 'portfolio_category';
$post_tag = 'portfolio_tag';

if( !post_type_exists( $post_type ) ) {

	$labels = array(
		'name'               => __( 'Portfolio', 'portfolio-post-type' ),
		'singular_name'      => __( 'Portfolio Item', 'portfolio-post-type' ),
		'menu_name'          => _x( 'Portfolio', 'admin menu', 'portfolio-post-type' ),
		'name_admin_bar'     => _x( 'Portfolio Item', 'add new on admin bar', 'portfolio-post-type' ),
		'add_new'            => __( 'Add New Item', 'portfolio-post-type' ),
		'add_new_item'       => __( 'Add New Portfolio Item', 'portfolio-post-type' ),
		'new_item'           => __( 'Add New Portfolio Item', 'portfolio-post-type' ),
		'edit_item'          => __( 'Edit Portfolio Item', 'portfolio-post-type' ),
		'view_item'          => __( 'View Item', 'portfolio-post-type' ),
		'all_items'          => __( 'All Portfolio Items', 'portfolio-post-type' ),
		'search_items'       => __( 'Search Portfolio', 'portfolio-post-type' ),
		'parent_item_colon'  => __( 'Parent Portfolio Item:', 'portfolio-post-type' ),
		'not_found'          => __( 'No portfolio items found', 'portfolio-post-type' ),
		'not_found_in_trash' => __( 'No portfolio items found in trash', 'portfolio-post-type' ),
	);

	$supports = array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'comments',
		'author',
		'custom-fields',
		'revisions',
	);

	$args = array(
		'labels'          => $labels,
		'supports'        => $supports,
		'public'          => true,
		'capability_type' => 'post',
		'rewrite'         => array( 'slug' => 'portfolio' ), // Change slug here for portfolio
		'menu_position'   => 5,
		'menu_icon'       => 'dashicons-portfolio',
		'has_archive'     => true,
	);

	register_post_type( $post_type, $args );

	/* 2. Portfolio categories */

	$labels = array(
		'name'                       => __( 'Portfolio Categories', 'portfolio-post-type' ),
		'singular_name'              => __( 'Portfolio Category', 'portfolio-post-type' ),
		'menu_name'                  => __( 'Portfolio Categories', 'portfolio-post-type' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'portfolio-post-type' ),
		'update_item'                => __( 'Update Portfolio Category', 'portfolio-post-type' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'portfolio-post-type' ),
		'new_item_name'              => __( 'New Portfolio Category Name', 'portfolio-post-type' ),
		'parent_item'                => __( 'Parent Portfolio Category', 'portfolio-post-type' ),
		'parent_item_colon'          => __( 'Parent Portfolio Category:', 'portfolio-post-type' ),
		'all_items'                  => __( 'All Portfolio Categories', 'portfolio-post-type' ),
		'search_items'               => __( 'Search Portfolio Categories', 'portfolio-post-type' ),
		'popular_items'              => __( 'Popular Portfolio Categories', 'portfolio-post-type' ),
		'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'portfolio-post-type' ),
		'add_or_remove_items'        => __( 'Add or remove portfolio categories', 'portfolio-post-type' ),
		'choose_from_most_used'      => __( 'Choose from the most used portfolio categories', 'portfolio-post-type' ),
		'not_found'                  => __( 'No portfolio categories found.', 'portfolio-post-type' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => $post_category ), // Change slug here
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( $post_category, $post_type, $args ); // Change slug here

	/* 2. Portfolio tags */

	$labels = array(
		'name'                       => __( 'Portfolio Tags', 'portfolio-post-type' ),
		'singular_name'              => __( 'Portfolio Tag', 'portfolio-post-type' ),
		'menu_name'                  => __( 'Portfolio Tags', 'portfolio-post-type' ),
		'edit_item'                  => __( 'Edit Portfolio Tag', 'portfolio-post-type' ),
		'update_item'                => __( 'Update Portfolio Tag', 'portfolio-post-type' ),
		'add_new_item'               => __( 'Add New Portfolio Tag', 'portfolio-post-type' ),
		'new_item_name'              => __( 'New Portfolio Tag Name', 'portfolio-post-type' ),
		'parent_item'                => __( 'Parent Portfolio Tag', 'portfolio-post-type' ),
		'parent_item_colon'          => __( 'Parent Portfolio Tag:', 'portfolio-post-type' ),
		'all_items'                  => __( 'All Portfolio Tags', 'portfolio-post-type' ),
		'search_items'               => __( 'Search Portfolio Tags', 'portfolio-post-type' ),
		'popular_items'              => __( 'Popular Portfolio Tags', 'portfolio-post-type' ),
		'separate_items_with_commas' => __( 'Separate portfolio tags with commas', 'portfolio-post-type' ),
		'add_or_remove_items'        => __( 'Add or remove portfolio tags', 'portfolio-post-type' ),
		'choose_from_most_used'      => __( 'Choose from the most used portfolio tags', 'portfolio-post-type' ),
		'not_found'                  => __( 'No portfolio tags found.', 'portfolio-post-type' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'hierarchical'      => false,
		'rewrite'           => array( 'slug' => $post_tag ), // Change slug here
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( $post_tag, $post_type, $args );  // Change slug here

}

if ( ! function_exists( 'scent_include_files' ) ) {

	function scent_include_files() {

		/**
		 * Custom template tags for this theme.
		 */
		require get_template_directory() . '/inc/template-tags.php';

		/**
		 * Custom functions that act independently of the theme templates.
		 */
		require get_template_directory() . '/inc/extras.php';

		/**
		 * Plugins activation.
		 */
		require get_template_directory() . '/inc/plugins.php';

		/**
		 * Meta Boxes.
		 */
		require get_template_directory() . '/inc/meta-boxes.php';

		/**
		 * Theme Options.
		 */
		require get_template_directory() . '/inc/options-init.php';

	}

}

add_action( "after_setup_theme", "scent_include_files" );


/* Menu
-------------------------------------------------------------------------------------------------------------------*/

add_filter('page_link', 'scent_filterPageLink', 10, 3);

function scent_filterPageLink($link, $id) {

	$parent_id = get_post_ancestors($id);

	$template = get_page_template_slug($id);

    if (!is_admin() && !empty($parent_id) && !empty($template) ) {

        $link = basename($link);

        $link = str_replace('?page_id=', 'section-', $link);

        $link = trailingslashit( get_permalink($parent_id[0]) ) . '#' . $link;            

    }

    return $link;
}

function scent_getScentPageID($page_ID) {

    $anchor = basename(get_permalink($page_ID));

    $anchor = str_replace('#', '', $anchor);

    return apply_filters('scent_page_id', $anchor);
}


/* Fix some problems with metaboxes-framework url */
function update_cmb_meta_box_url( $url ) {
    // modify the url here
    $url = get_template_directory_uri().'/plugins/metaboxes-framework';
    return $url;
}
add_filter( 'cmb_meta_box_url', 'update_cmb_meta_box_url' );


