/*****************************************************************
 * **************************************************************
 * @MetCreative - Table of Contents
 * 1-) Document Ready State
 *    a- Vertically Centering
 *    b- Scroll Speed and Styling
 *    c- Slider
 *    d- Blog Slider
 *    e- DL Menu
 *    f- Skill Circles
 *    g- Company News
 *    h- LightBox
 *    i- Twitter Ticker on Coming Soon
 *    j- Sidebar Flickr
 *    k- Parallax
 *    l- Recent Works
 *    m- Portfolio
 *    n- Met Accordion
 *    o- Tabs
 *    p- Skill Bar Filling
 *    q- Testimonials
 *    r- Parallax Testimonials
 *    s- Blog Widget
 *    t- Gmaps JS for Google Maps
 *    u- Php Ajax Contact Form
 *    v- Coming Soon Mail Saver
 *    w- Blog Post Height Adjusting
 *    x- Main Menu
 *    y- Countdown
 *    z- Fixed Header
 *    aa- Twitter Ticker
 *    ab- Info Box Slider
 *    ac- Brands Carousel
 * 2-) Functions
 *    a- Element Height Adjuster
 *    b- Sticky Header Resizing
 * !Note: You can make search with one of the title above to find the block according to it
 * **************************************************************
 *****************************************************************/
(function($) {
	"use strict";
	/**
	 * Vertically Centering
	 * @usedPlugins jquery,flexbox-fallback
	 */
	if($('html').hasClass('no-flexbox') && $('html').hasClass('no-flexboxlegacy')){
		if($('header nav > ul > li > a').length > 0) $('header nav > ul > li > a').flexVerticalCenter('top');
		if($('.met_parallax_line.met_vcenter .met_content').length > 0) $('.met_parallax_line.met_vcenter .met_content').flexVerticalCenter('top');
		if($('.met_recent_work_overlay.met_vcenter > div').length > 0) $('.met_recent_work_overlay.met_vcenter > div').flexVerticalCenter('top');
		if($('.knob .met_bgcolor.met_vcenter i').length > 0) $('.knob .met_bgcolor.met_vcenter i').flexVerticalCenter('top');
		if($('.met_header_socials.met_vcenter a').length > 0) $('.met_header_socials.met_vcenter a').flexVerticalCenter('top');
		if($('.met_portfolio2_item_overlay.met_vcenter .met_portfolio2_item_miscs').length > 0) $('.met_portfolio2_item_overlay.met_vcenter .met_portfolio2_item_miscs').flexVerticalCenter('top');
		if($('.met_parallax_content.met_vcenter .met_parallax_content_box').length > 0) $('.met_parallax_content.met_vcenter .met_parallax_content_box').flexVerticalCenter('top');

	}
	if($('.dl-menuwrapper').length > 0) $('.dl-menuwrapper').flexVerticalCenter('top');

	/**
	 * Scroll Speed and Styling
	 * @usedPlugins jquery,nicescroll
	 * @usedAt      Every page that contains body tag with data-smooth-scrolling 1
	 */
	if($('body').attr('data-smooth-scrolling') == 1 && !$('html').hasClass('touch')){
		$("html").niceScroll({
			scrollspeed: 60,
			mousescrollstep: 35,
			cursorwidth: 5,
			cursorcolor: '#63C6AE',
			cursorborder: 'none',
			background: 'rgba(255,255,255,0.3)',
			cursorborderradius: 3,
			autohidemode: false,
			cursoropacitymin: 0.1,
			cursoropacitymax: 1
		});
	}



	/**
	 * Slider
	 * @usedPlugins jquery, jquery-easing-1.3, jquery-transit-modified, layerslider.kreaturamedia, layerslider.transitions
	 * @usedAt      Home Page
	 */
	var layerSlider = $('#layerslider');
	if(layerSlider.length > 0){
		layerSlider.layerSlider({
			width : '100%',
			height: '600px',
			skinsPath : 'layerslider_skins/',
			skin : 'fullwidth',
			thumbnailNavigation : 'hover',
			hoverPrevNext : false,
			responsive : true,
			responsiveUnder: 1270,
			sublayerContainer : 1270,
			touchNav : true,
			navStartStop: false,
			navButtons: false
		});
	}

	/**
	 * Blog Slider
	 * @usedPlugins jquery, jquery-easing-1.3, jquery-transit-modified, layerslider.kreaturamedia, layerslider.transitions
	 * @usedAt      Home Page
	 */
	var met_blog_slider = $('.met_blog_slider');
	if(met_blog_slider.length > 0){
		met_blog_slider.layerSlider({
			skinsPath : 'layerslider_skins/',
			hoverPrevNext : false,
			responsive : true,
			skin : 'noskin',
			thumbnailNavigation : 'hover',
			showCircleTimer : false,
			showBarTimer : false,
			touchNav : true,
			navButtons: true
		});
	}

	/**
	 * DL Menu
	 * @usedPlugins jquery, dlmenu
	 * @usedAt      shortcode
	 */
	var dl_menu = $('#dl-menu');
	if(dl_menu.length > 0)
		dl_menu.dlmenu({
			animationClasses : { 'in' : 'dl-animate-in-3', 'out' : 'dl-animate-out-3' }
		});

	/**
	 * Skill Circles
	 * @usedPlugins jquery, jquery.knob, jquery.easing-1.3
	 * @usedAt      Home Page
	 */
	var container = $('.dial');
	container.each(function() {
		var that = $(this),
			w = container.data('width'),
			v = that.data('value'),
			t = that.data('thickness'),
			mid = that.next(),
			span = mid.next();
		that.next().remove();
		that/*.addClass('visible')*/.knob({
			readOnly: true,
			bgColor: '#F7F7F7',
			fgColor: '#63C6AE',
			thickness: t / 100,
			angleOffset: 180,
			width: w,
			height: w
		});
		that.parent().append(
			mid.css({
				'top' : t+'px',
				'left' : t+'px',
				'width' : (w - t * 2)+'px',
				'height' :  (w - t * 2)+'px',
				'font-size' : (w / 2 - t)+'px'
			})
		);
		$({value: 0}).animate({value: v}, {
			duration: 2000,
			easing:'easeOutQuad',
			step: function() {
				that.val(Math.ceil(this.value)).trigger('change');
				span.html('&nbsp;'+Math.ceil(this.value)+'%');
			}
		});
	});

	/**
	 * Company News
	 * @usedPlugins jquery,caroufredsel
	 * @usedAt      Home Page 3
	 */
	var company_news = $(".met_company_news");
	if(company_news.length > 0){
		company_news.imagesLoaded(function(){
			company_news.carouFredSel({
				responsive: true,
				prev: {
					button : function(){
						return $(this).parents('.met_company_news_wrapper').find('nav a:first-child')
					}
				},
				next:{
					button : function(){
						return $(this).parents('.met_company_news_wrapper').find('nav a:last-child')
					}
				},
				width: '100%',
				circular: false,
				infinite: true,
				auto: {
					play : true,
					pauseDuration: 0,
					duration: 2000
				},
				scroll: {
					items: 1,
					duration: 400,
					wipe: true
				},
				items: {
					visible: {
						min: 1,
						max: 3
					}
				},
				swipe : {
					onTouch : $('html').hasClass('no-touch') ? false : true
				}
			});
		});
	}

	/**
	 * LightBox
	 * @usedPlugins jquery, magnific-popup
	 * @usedAt      portfolio
	 */
	var rel_lb = $('[rel*="lb"]');
	rel_lb.each(function(){
		$('[rel="'+$(this).attr('rel')+'"]').magnificPopup({
			type: 'image',
			gallery:{
				enabled: true
			},
			mainClass: 'mfp-3d'
		});
	});
	var rel_video_lb = $('[rel*="video_lb"]');
	rel_video_lb.each(function(){
		$('[rel="'+$(this).attr('rel')+'"]').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false,
			mainClass: 'mfp-3d'
		});
	});

	/**
	 * Twitter Ticker on Coming Soon
	 * @usedPlugins jquery,caroufredsel
	 * @usedAt      Twitter ticker on Coming Soon page
	 */
	var met_coming_soon_twitter = $('.met_coming_soon_twitter');
	if(met_coming_soon_twitter.length > 0){
		$.getJSON('twitter/get-tweets1.1.php?placement=comingSoon',
			function(feeds) {
				met_coming_soon_twitter.html('');
				for (var i=0; i<feeds.length; i++) {
					var status = feeds[i].text;
					met_coming_soon_twitter.append('<div>'+status+'</div>');
				}
			}).done(function(){
				met_coming_soon_twitter.carouFredSel({
					responsive: true,
					width: '100%',
					circular: false,
					infinite: true,
					auto: {
						play : true,
						pauseDuration: 0,
						duration: 1000
					},
					scroll: {
						items: 1,
						duration: 400,
						wipe: true,
						pauseOnHover: false,
						fx: 'crossfade'
					},
					items: {
						visible: {
							min: 1,
							max: 1  },
						width: 620,
						height: 'auto'
					},
					swipe : {
						onTouch : true
					}
				});
			});
	}

	/**
	 * Sidebar Flickr
	 * @usedPlugins jquery, jflickrfeed.min
	 * @usedAt      Flickr Feed on Sidebar
	 */
	var met_sidebar_flickr = $('.met_sidebar_flickr');
	if(met_sidebar_flickr.length > 0){
		met_sidebar_flickr.jflickrfeed({
			limit: 10,
			qstrings: {
				id: '33234404@N06'
			},
			itemTemplate: '<li><a href="{{image_b}}" target="_blank" class="met_transition"><img src="{{image_s}}" alt="{{title}}"></a></li>'
		});
	}


	/**
	 * Parallax
	 * @usedPlugins jquery, parallax
	 * @usedAt      Parallax Lines on Pages
	 */
	if(!$('html').hasClass('touch')){
		var met_parallax_item_1 = $(".met_parallax_item_1");
		met_parallax_item_1.length > 0 ? met_parallax_item_1.parallax("50%", "0") : true;
	}


	/**
	 * Recent Works
	 * @usedPlugins jquery, isotope, imagesLoaded, hoverdir
	 * @usedAt      Recent Works
	 */
	var met_recent_works = $('.met_recent_works,.met_portfolio2');
	var fl = false;
	if(met_recent_works.length > 0){
		met_recent_works.imagesLoaded(function(){
			// filter items when filter link is clicked
			$('.met_recent_works_header a,.met_portfolio2_filters a').click(function(){
				if(!$(this).hasClass('activeLink') || !fl){
					fl = true;
					var selector = $(this).attr('data-filter');
					$('.activeLink').removeClass('activeLink');
					$(this).addClass('activeLink');
					met_recent_works.isotope({ filter: selector });
				}
				return false;
			});
			met_recent_works.isotope({});
			$('.met_recent_works_header select,.met_portfolio2_filters select').on('change',function(){
				var selector = $(this).val();
				met_recent_works.isotope({ filter: selector });
			});
			$('.met_recent_works_header a.activeLink,.met_portfolio2_filters a.activeLink').click();

			$('.met_portfolio2_view_all').click(function(e){
				e.preventDefault();
				if($('.met_portfolio2_filters a.activeLink').length > 0){
					$('.met_portfolio2_filters a.activeLink').removeClass('activeLink');
					met_recent_works.isotope({ filter: '*' });
				}
			});

			$(window).smartresize(function(){met_recent_works.isotope('reLayout');});
		});
	}

	$('.met_recent_work_preview').each(function(){
		$(this).hoverdir({
			speed: 300,
			easing: 'ease',
			hoverDelay: 0,
			inverse: false
		});
	});

	/**
	 * Portfolio
	 * @usedPlugins jquery, isotope, imagesLoaded, hoverdir
	 * @usedAt      Portfolio
	 */
	var container = $('.met_portfolio');
	if(container.length > 0){
		container.imagesLoaded(function(){
			// filter items when filter link is clicked
			$('.met_portfolio_filters a').click(function(){
				if(!$(this).hasClass('activePortfolio')){
					var selector = $(this).attr('data-filter');
					$('.activePortfolio').removeClass('activePortfolio');
					$(this).addClass('activePortfolio');
					container.isotope({ filter: selector });
				}
				return false;
			});
			container.isotope({});
			$('.met_portfolio_filters').next('select').on('change',function(){
				var selector = $(this).val();
				container.isotope({ filter: selector });
			});
			$(window).smartresize(function(){container.isotope('reLayout');});
		});
	}



	/**
	 * Met Accordion
	 * @usedPlugins jquery
	 * @usedAt      About Us
	 */
	var met_accordion_on = $('.met_accordion.met_accordion_on');
	met_accordion_on.find('.met_accordion_content').slideDown();
	met_accordion_on.find('icon-plus').removeClass('icon-plus').addClass('icon-minus');

	$('.met_accordion_head').click(function(){
		var thisAccordion         = $(this);
		var thisAccordionParent   = thisAccordion.parent();
		var accordionContainer   = thisAccordionParent.parent();

		if(thisAccordionParent.hasClass('met_accordion_on')){
			thisAccordionParent.removeClass('met_accordion_on');
			thisAccordion.next().slideUp();
			thisAccordion.find('.icon-minus').removeClass('icon-minus').addClass('icon-plus');
		}else{
			accordionContainer.find('.met_accordion_on').removeClass('met_accordion_on').children('.met_accordion_content').slideUp().parent().find('.icon-minus').removeClass('icon-minus').addClass('icon-plus');
			thisAccordionParent.addClass('met_accordion_on').children('.met_accordion_content').slideDown().parent().find('.icon-plus').removeClass('icon-plus').addClass('icon-minus');
		}
	});

	/**
	 * Tabs
	 * @usedPlugins jquery, bootstrap
	 * @usedAt      Tabbed Contents
	 */
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	/**
	 * Skill Bar Filling
	 * @usedPlugins jquery
	 * @usedAt      About Us
	 */
	function scrollBarFiller(){
		var scrollTop = $(window).scrollTop();
		var bars = $('.not-loaded');
		bars.each(function(){
			var offsetTop = $(this).offset().top;
			var evenThem = offsetTop - scrollTop - $(window).height() + $(this).height();
			if(evenThem <= 0){
				$(this).removeClass('not-loaded');
				$(this).css('width', $(this).data('width')+'%');
			}

		});
	}
	$(window).scroll(function(){
		var scrolling;
		scrolling = setInterval(function(){
			scrollBarFiller();
			clearInterval(scrolling);
		},100);
	});

	/**
	 * Testimonials
	 * @usedPlugins jquery, caroufredsel
	 * @usedAt      About Us
	 */
	var met_testimonials = $(".met_testimonials");
	if(met_testimonials.length > 0){
		met_testimonials.carouFredSel({
			responsive: true,
			prev: {
				button : function(){
					return $(this).parents('.met_testimonials_wrapper').find('.met_carousel_prev')
				}
			},
			next:{
				button : function(){
					return $(this).parents('.met_testimonials_wrapper').find('.met_carousel_next')
				}
			},
			infinite: true,
			auto: {
				play : true,
				pauseDuration: 0,
				duration: 500
			},
			scroll: {
				items: 1,
				duration: 400,
				wipe: true,
				pauseOnHover: true,
				fx: 'crossfade'
			},
			items: {
				visible: {
					min: 1,
					max: 1
				}
			},
			swipe : {
				onTouch : $('html').hasClass('no-touch') ? false : true
			}
		});
	}

	/**
	 * Parallax Testimonials
	 * @usedPlugins jquery, caroufredsel
	 * @usedAt      Home Page
	 */
	var met_parallax_testimonials = $(".met_parallax_testimonials");
	if(met_parallax_testimonials.length > 0){
		met_parallax_testimonials.carouFredSel({
			responsive: true,
			prev: {
				button : function(){
					return $(this).parents('.met_parallax_content').find('.met_parallax_testimonials_prev')
				}
			},
			next:{
				button : function(){
					return $(this).parents('.met_parallax_content').find('.met_parallax_testimonials_next')
				}
			},
			infinite: true,
			auto: {
				play : true,
				pauseDuration: 0,
				duration: 500
			},
			scroll: {
				items: 1,
				duration: 400,
				wipe: true,
				pauseOnHover: true,
				fx: 'crossfade'
			},
			items: {
				visible: {
					min: 1,
					max: 1
				},
				height: 'variable'
			},
			swipe : {
				onTouch : $('html').hasClass('no-touch') ? false : true
			}
		});
	}

	/**
	 * Blog Widget
	 * @usedPlugins jquery, caroufredsel
	 * @usedAt      Home Page
	 */
	var met_blog_widget = $(".met_blog_widget");
	if(met_blog_widget.length > 0){
		met_blog_widget.carouFredSel({
			responsive: true,
			prev: {
				button : function(){
					return $(this).parents('.met_blog_widget_wrapper').find('.met_blog_widget_nav a:first-child')
				}
			},
			next:{
				button : function(){
					return $(this).parents('.met_blog_widget_wrapper').find('.met_blog_widget_nav a:last-child')
				}
			},
			infinite: true,
			auto: {
				play : true,
				pauseDuration: 0,
				duration: 500
			},
			scroll: {
				items: 1,
				duration: 400,
				wipe: true,
				pauseOnHover: true,
				fx: 'crossfade'
			},
			items: {
				visible: {
					min: 1,
					max: 1
				},
				height: 'variable'
			},
			swipe : {
				onTouch : $('html').hasClass('no-touch') ? false : true
			}
		});
	}

	/**
	 * Gmaps JS for Google Maps
	 * @usedPlugins gmaps,gmaps sensor
	 * @usedAt      Contact page
	 */
	if($('#map').length > 0){
		var map = new GMaps({
			div: '#map',
			lat: 25.829088,
			lng: -80.18125,
			scrollwheel: false
		});
		map.addMarker({
			lat: 25.829088,
			lng: -80.18125,
			title: 'MetCreative Office'
		});
	}

	/**
	 * Php Ajax Contact Form
	 * @usedPlugins jquery
	 * @usedAt      Contact Page
	 */
	$('.met_contact_form').bind('submit', function(){
		var form    = $(this);
		var me      = $(this).children('button[type=submit]');

		me.attr('disabled','disabled');

		$.ajax({
			type: "POST",
			url: "mail.php",
			data: form.serialize(),
			success: function(returnedInfo){

				var message = $('.met_contact_thank_you');
				returnedInfo == 1 ? message.show() : message.html('Our Mail Servers Are Currently Down').show();
				setInterval(function(){message.fadeOut()},5000);
				me.removeAttr('disabled');

			}
		});
		return false;
	});



	/**
	 * Coming Soon Mail Saver
	 * @usedPlugins jquery
	 * @usedAt      Coming Soon Page
	 */
	$('.met_coming_soon_maillist').bind('submit', function(){
		var form    = $(this);
		var me      = $(this).children('button[type=submit]');

		me.attr('disabled','disabled');

		$.ajax({
			type: "POST",
			url: "mail.php",
			data: form.serialize(),
			success: function(returnedInfo){

				var message = $('.met_coming_soon_message');

				if(returnedInfo == '0') message.html('Uuups! Sorry, There are some technical issues, please try again later.');
				message.addClass('message_sent');

				me.removeAttr('disabled');

			}
		});
		return false;
	});


	/**
	 * Blog Post Height Adjusting
	 * @usedPlugins jquery
	 * @usedAt      Blog
	 */
	var met_blog_preview_iframe = $('.met_blog_preview iframe');
	met_blog_preview_iframe.length > 0 ? $(window).load(function(){$(window).smartresize(function(){heightAdjuster(met_blog_preview_iframe);}).smartresize();}) : true;



	/**
	 * Main Menu
	 * @usedPlugins jquery, superfish, hoverIntent
	 * @usedAt      Global
	 */
	var main_menu = $('header nav ul');
	if(main_menu.length > 0 && !$('html').hasClass('touch')){
		main_menu.superfish({
			delay: 250
		});
	}


	/**
	 * Countdown
	 * @usedPlugins jquery, countdown.min
	 * @usedAt      Coming Soon Page
	 */
	var launchTime = new Date(2013,12,10,0); // Set launch: [year], [month], [day], [hour]...
	//launchTime.setDate(launchTime.getDate() + 25); // Add 13 days
	var countdown = $("#countdown");
	countdown.length > 0 ? countdown.countdown({until: launchTime, format: "odHMS"}) : true;


	/**
	 * Fixed Header
	 * @usedPlugins jquery
	 * @usedAt      Header
	 */
	var met_fixed_header = $('.met_fixed_header');
	met_fixed_header.next().css('margin-top',met_fixed_header.height()+'px');
	$(window).bind('resize', function(){
		met_fixed_header.next().css('margin-top',met_fixed_header.height()+'px');
	});

	/**
	 * Twitter Ticker
	 * @usedPlugins jquery,caroufredsel
	 * @usedAt      Twitter ticker above footer
	 */
	var met_footer_twits = $('.met_footer_twits');
	if(met_footer_twits.length > 0){
		$.getJSON('twitter/get-tweets1.1.php?placement=footer',
			function(feeds) {
				met_footer_twits.html('');
				for (var i=0; i<feeds.length; i++) {
					var status = feeds[i].text;
					$('.met_footer_twits').append('<div class="met_footer_twit_item">'+status+'</div>');
				}
			}).done(function(){
				met_footer_twits.carouFredSel({
					responsive: false,
					circular: true,
					infinite: true,
					auto:{
						play : true,
						pauseDuration: 0,
						duration: 1000
					},
					scroll: {
						duration: 400,
						wipe: true,
						pauseOnHover: true
					},
					items:{
						visible:{
							min: 2,
							max: 2
						},
						height: 'variable'
					},
					height: 'variable',
					direction: 'up',
					swipe:{
						onTouch:true
					},
					onCreate: function(){
						$(window).trigger('resize');
					}
				});
			});
	}

	/**
	 * Info Box Slider
	 * @usedPlugins jquery, caroufredsel
	 * @usedAt      Services
	 */
	var info_box_slider = $(".met_icon_info_box_slider");
	if(info_box_slider.length > 0){
		info_box_slider.carouFredSel({
			responsive: false,
			infinite: true,
			auto: {
				play : true,
				pauseDuration: 0,
				duration: 500
			},
			scroll: {
				items: 1,
				duration: 400,
				wipe: true,
				pauseOnHover: true,
				fx: 'crossfade'
			},
			items: {
				visible: {
					min: 1,
					max: 1
				},
				height: '100%',
				width: '100%'
			},
			height: '100%',
			width: '100%',
			swipe : {
				onTouch : $('html').hasClass('no-touch') ? false : true
			}
		});
	}

	/**
	 * Brand Carousel
	 * @usedPlugins jquery, caroufredsel
	 * @usedAt      Services
	 */
	var met_brands_carousel = $(".met_brands_carousel");
	if(met_brands_carousel.length > 0){
		met_brands_carousel.imagesLoaded(function(){
			met_brands_carousel.carouFredSel({
				responsive: false,
				auto: false,
				prev: {
					button : function(){
						return $(this).parents('.met_brands_carousel_wrapper').find('.met_brands_carousel_prev')
					}
				},
				next:{
					button : function(){
						return $(this).parents('.met_brands_carousel_wrapper').find('.met_brands_carousel_next')
					}
				},
				items: {
					visible: 8,
					height: 'variable'
				},
				scroll: {
					items: 1
				},
				width: '100%'
			});
		});
	}

	stickyHeaderSize();
	$(window).bind('resize', stickyHeaderSize);

	/**
	 * Element Height Adjuster
	 * @usedPlugins jquery
	 */
	function heightAdjuster(element){
		var w               = element.data('width');
		var h               = element.data('height');
		var currentWidth    = element.width();
		var ratio           = h / w;
		var newHeight       = currentWidth * ratio;
		element.css('height', newHeight+'px');
	}

	/**
	 * Sticky Header Resizing
	 * @usedAt      global, dom ready, window resize
	 */
	function stickyHeaderSize(){
		if($('.met_boxed_layout').length > 0 && $('.met_fixed_header').length > 0){
			var fixed_header = $('.met_fixed_header');
			fixed_header.attr('data-fixed-width', $('.met_page_wrapper').width()+'px');
			fixed_header.attr('data-fixed-left', $('.met_page_wrapper').offset().left+'px');

			fixed_header.css({
				'left' : fixed_header.attr('data-fixed-left'),
				'width' : fixed_header.attr('data-fixed-width')
			});
		}
	}

})(jQuery);