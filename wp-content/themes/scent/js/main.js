(function($) {
	"use strict";

	$(document).ready(function() {

		var navbarHeight = $('.navbar').outerHeight();

		$('.post-thumb, p, .portfolio-thumb-large').fitVids( {customSelector: "iframe[src^='http://v.wordpress.com'], iframe[src^='http://www.youtube.com']"} );

		// Top Menu Animation
		
		$(window).scroll(function(){
			if ($(this).scrollTop() > 10) {
				$('body.page-template-page-home-php.hide-nav .navbar').css('top', '0');
			} else {
				$('body.page-template-page-home-php.hide-nav .navbar').css('top', '-' + navbarHeight + 'px');
			}
		});


		// ====================================================================

		// Home Slide Height

		$('#home').css({'height': (($(window).height()-0))+'px'});
		$(window).resize(function(){
			$('#home').css({'height': (($(window).height()-0))+'px'});
		});


		// ====================================================================

		// Superslides

		$('.fs-slider').each(function(){

			var play = parseInt( $(this).attr('data-pause') );
			var animation = $(this).attr('data-effect');
			var animation_speed = parseInt( $(this).attr('data-animation') );
			var inherit_width_from = $(this).attr('data-width');
			var inherit_height_from = $(this).attr('data-height');
			if( $(this).attr('data-pagination') == 'on' ) {
				var pagination = 1;
			} else {
				var pagination = 0;
			}

			$(this).superslides({
				play: 5000,
				animation_speed: 2000,
				animation: 'fade',
				//pagination: pagination,
				//inherit_width_from: inherit_width_from,
				//inherit_height_from: inherit_height_from
			});

		});


		// ====================================================================

		// Owl Carousel

		$(".staff-carousel").each(function(){
			var columns = $(this).attr('data-columns');
			$(this).owlCarousel({
				items: columns,
				slideSpeed: 800
			});
		});

		$(".testimonials-carousel").each(function(){
			var speed = $(this).attr('data-speed');
			var interval = $(this).attr('data-interval');
			$(this).owlCarousel({
				singleItem: true,
				navigation: false,
				pagination: false,
				slideSpeed: speed,
				autoHeight: true,
				autoPlay: interval
			});
		});

		$(".blog-carousel").each(function(){
			var columns = $(this).attr('data-visible');
			$(this).owlCarousel({
				items: columns,
				itemsDesktop: columns,
				itemsDesktopSmall: columns,
				itemsTablet: 1,
				navigation: false,
				pagination: true,
				slideSpeed: 800,
				autoHeight: true
			});
		});


		// ====================================================================

		// Fancybox

		$('.gallery').each(function(){
			var uid = Math.floor(Math.random() * 100);
			$('a', this).attr('rel', 'gallery-' + uid);
		});

		$('.gallery a').fancybox({
			openEffect: 'none'
		});

		// ====================================================================

		// Scrolly

		$('.parallax').scrolly();

		// ====================================================================

		// Models Filter

		if( $().mixitup ) {
			$('.models').mixitup({
		        layout: {
		            display: 'block'
		        },
		        controls: {
			        scope: 'local'
			    }
		    });
		}

		// ====================================================================

		// Portfolio Filter

		if( $().mixitup ) {
			$('.portfolio').mixitup({
		        layout: {
		            display: 'block'
		        },
		        controls: {
			        scope: 'local'
			    }
		    });
		}

		// ===================================================================

		// Sidebar Menu

		$('.widget_recent_entries li a, .widget_categories li a, .widget_archive li a, .widget_pages li a, .widget_meta li a, .recentcomments').append("<i class='fa fa-angle-right'></i>");

		$('.widget_categories li, .widget_archive li').each(function(){
			var clone = $('a', this).clone();
			$(this).empty().append(clone);
		});
		

		$('.comment-reply-link, .post-password-form input[type="submit"]').addClass('btn btn-default');
		$('input.wpcf7-submit, #commentform input[type="submit"]').addClass('btn btn-primary btn-lg');
		$('.vc_btn.vc_btn_white').addClass('btn btn-default');

		$('.staff-columns-2 .item').addClass('col-sm-6');
		$('.staff-columns-3 .item').addClass('col-sm-4');
		$('.staff-columns-4 .item').addClass('col-sm-3');

		$('.post-password-form input[type="password"], .widget_categories select, .widget_archive select').addClass('form-control');


		// ===================================================================

		// Fullscreen Sections

		function fullscreen() {

			var w_height = $(window).height();

			$('section.fullscreen').each(function(){
				$(this).css('min-height', w_height + 'px');
			});
		}

		fullscreen();

		$(window).resize(function(){
			fullscreen();
		});


		// ====================================================================

		// Menu Item Activation

		$('.navbar-collapse a').each(function(){

			var location = window.location.toString();
			var url = $(this).attr('href');
			var hash = url.substring( url.indexOf('#') );
			var clean_url = url.replace(hash, '');

			if( location === hash ) hash = '#top';

			if( location = clean_url ) $(this).attr('data-target', hash);

		});

		$('body').scrollspy({
			target: '.navbar-collapse',
			offset: 70
		})

		$('[data-spy="scroll"]').each(function () {
			var $spy = $(this).scrollspy('refresh');
		});


		// ====================================================================

		// Smooth Scroll on Menu Click

		$(".navbar-nav a[href*='#'], .welcome a").not('.navbar-nav a[href="#"]').on("click",function(){
			var t= $(this.hash);
			var t=t.length&&t||$('[name='+this.hash.slice(1)+']');
			if(t.length){
				var tOffset=t.offset().top - navbarHeight;
				$('html,body').animate({scrollTop:tOffset},'slow');
				return false;
			}
		});

		$(".navbar-nav a[href*='#'], .welcome a").not('.navbar-nav a[href="#"]').on("click",function(){
		    $('.navbar-toggle').click();
		});

		$(window).one("load", function(event) {
			$( window.location.hash ).scroll();
		});

	});

})(jQuery);