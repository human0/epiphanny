<?php
/**
 * The Header for our theme.
 *
 * @package Scent
 */
?><!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php

/* Get theme options */
global $theme_scent;


/* Array of extra BODY classes */
$body_class = array();


/* Define BODY layout class */
if( $theme_scent['page_layout'] == 'boxed' ) {
    $body_class[] = 'layout-boxed';
} else {
    $body_class[] = 'layout-wide';
}


/* Get hide navigation option */
if( $theme_scent['hide_nav'] ) {
    $body_class[] = 'hide-nav';
}


/* Set favicons */

if( !empty( $theme_scent['favicon']['url'] ) ): ?>
<link rel="shortcut icon" href="<?php echo $theme_scent['favicon']['url']; ?>" type="image/x-icon"><?php
endif;

if( !empty( $theme_scent['favicon_mobile']['url'] ) ): ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo $theme_scent['favicon_mobile']['url']; ?>"><?php
endif;

if( !empty( $theme_scent['favicon_tablet']['url'] ) ): ?>
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $theme_scent['favicon_tablet']['url']; ?>"><?php
endif;


/* Get logo */
if( empty($theme_scent['logo']['url']) || $theme_scent['logo'] == 'logo.gif' ) {
	if($theme_scent['theme_color'] == 'white') {
		$logo = get_template_directory_uri() . '/img/logo-light.gif';
	} else {
		$logo = get_template_directory_uri() . '/img/logo.gif';		
	}
} else {
	$logo = $theme_scent['logo']['url'];
}


/* Set header height */
$header_height = $theme_scent['header_height']; ?>

<style>
    .navbar-nav > li > a { line-height: <?php echo( $header_height['height'] ); ?> !important; }<?php
    if( !empty( $theme_scent['btn_gradient_color']['from'] ) && !empty( $theme_scent['btn_gradient_color']['to'] ) ) {
    	echo(" .btn-primary { background-image: linear-gradient(to bottom, " . $theme_scent['btn_gradient_color']['from'] . " 0px, " . $theme_scent['btn_gradient_color']['to'] . " 100%) !important; border-color: " . $theme_scent['btn_gradient_color']['to'] . " !important;} .btn-primary:hover { background-image: linear-gradient(to top, " . $theme_scent['btn_gradient_color']['from'] . " 0px, " . $theme_scent['btn_gradient_color']['to'] . " 100%) !important; }");
    } ?>
    #page > .container > .page-title, #content > .container > .page-title, #blog > .container > .page-title { margin-top: <?php echo( $header_height['height'] + 24 ); ?>px !important; }
</style>

<?php wp_head(); ?>

</head>

<body data-spy="scroll" data-target=".navbar-collapse" <?php body_class($body_class); ?>>

<div class="navbar navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"></a>
		</div><?php 

		if ( function_exists('icl_object_id') ) {
		    do_action('icl_language_selector');
		}

		wp_nav_menu( array(
		    'menu'              => 'primary',
		    'theme_location'    => 'primary',
		    'depth'             => 2,
		    'container'         => 'div',
		    'container_class'   => 'navbar-collapse collapse',
		    'menu_class'        => 'nav navbar-nav navbar-right',
		    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		    'walker'            => new wp_bootstrap_navwalker())
		); ?>
	</div>
</div>