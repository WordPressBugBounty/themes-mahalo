let timerInterval;
let timeClock = document.getElementById("twp-time-clock");


function myTimer() {
    const date = new Date();
    timeClock.innerHTML = date.toLocaleTimeString();
}

window.addEventListener("load", function () {
    document.body.classList.add("webpage-is-ready");
});



window.addEventListener("load", function(){

    jQuery(document).ready(function($){
        "use strict";

        let preloader = $("#theme-preloader-initialize");

        if (preloader.length) {
            let fadeOut = setInterval(function () {
                preloader.css("transition", "0.2s");

                if (!preloader.css("opacity")) {
                    preloader.css("opacity", 1);
                }
                if (parseFloat(preloader.css("opacity")) > 0) {
                    preloader.css("opacity", parseFloat(preloader.css("opacity")) - 0.2);
                } else {
                    preloader.css("display", "none");
                    clearInterval(fadeOut);
                }
            }, 100);
        }

    });

});

jQuery(document).ready(function ($) {
    "use strict";
    // Responsive Content

    if(timeClock){
        timerInterval = setInterval(myTimer, 1000);
    }

    // Hide Comments
    $('.mahalo-no-comment .booster-block.booster-ratings-block, .mahalo-no-comment .comment-form-ratings, .mahalo-no-comment .twp-star-rating').hide();
    $('.tooltips').append("<span></span>");
    $(".tooltips").mouseenter(function () {
        $(this).find('span').empty().append($(this).attr('data-tooltip'));
    });
    // Scroll To
    $(".top-header-add").click(function () {
        $("html, body").animate(
            {
                scrollTop: $("#site-header").offset().top,
            },
            800
        );
    });

    /**
    * Light & Dark Mode jQuery Toggle Using localStorage
    */    

    // Check for saved 'switchMode' in localStorage
    let switchMode = localStorage.getItem('switchMode');

    // Get selector
    const switchModeToggle = $(' .theme-colormode-switcher ');

    // Dark mode function
    const enableDarkMode = function() {
        // Add the class to the body
        $( 'body' ).addClass('theme-darkmode-enabled');
        // Update switchMode in localStorage
        localStorage.setItem('switchMode', 'enabled');
    }

    // Light mdoe function
    const disableDarkMode = function() {
        // Remove the class from the body
        $( 'body' ).removeClass('theme-darkmode-enabled');
        // Update switchMode in localStorage value
        localStorage.setItem('switchMode', null);
    }

    // If the user already visited and enabled switchMode
    if (switchMode === 'enabled') {
        enableDarkMode();
        // Dark icon enabled
        $( '.mode-icon-change' ).addClass( 'mode-icon-night' );
        $( '.mode-icon-change' ).removeClass( 'mode-icon-light' );
    } else {
        // Light icon enabled
        $( '.mode-icon-change' ).addClass( 'mode-icon-light' );
        $( '.mode-icon-change' ).removeClass( 'mode-icon-night' );
    }

    // When someone clicks the button
    switchModeToggle.on('click', function() {
        // Change switch icon
        $( '.mode-icon-change' ).toggleClass( 'mode-icon-light' );
        $( '.mode-icon-change' ).toggleClass( 'mode-icon-night' );

        // get their switchMode setting
        switchMode = localStorage.getItem('switchMode');

        // if it not current enabled, enable it
        if (switchMode !== 'enabled') {
            enableDarkMode();              
        // if it has been enabled, turn it off  
        } else {  
            disableDarkMode();              
        }
    });
    // on scroll disable add banner
    var distance = $("#site-header").offset().top,
      $window = $(window);
    $window.scroll(function () {
      if ($window.scrollTop() >= distance) {
        $(".theme-header-ads").addClass("header-add-top");
      }
    });

    // Rating disable
    if (mahalo_custom.single_post == 1 && mahalo_custom.mahalo_ed_post_reaction) {
        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();
    }
    // Add Class on article
    $('.theme-article-area').each(function () {
        $(this).addClass('theme-article-loaded');
    });
    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    // Header Search show
    $('.header-searchbar').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
    });
    $(".header-searchbar-inner").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    // Header Search hide
    $('#search-closer').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        setTimeout(function () {
            $('.navbar-control-search').focus();
        }, 300);
        $('body').removeClass('body-scroll-locked');
    });
    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function () {
        $('.header-searchbar').toggleClass('header-searchbar-active');
        setTimeout(function () {
            $('.header-searchbar .search-field').focus();
        }, 300);
        $('body').addClass('body-scroll-locked');
    });
    $('input, a, button').on('focus', function () {
        if ($('.header-searchbar').hasClass('header-searchbar-active')) {
            if ($(this).hasClass('skip-link-search-top')) {
                $('.header-searchbar #search-closer').focus();
            }
            if (!$(this).parents('.header-searchbar').length) {
                $('.header-searchbar .search-field').focus();
            }
        }
    });
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('.header-searchbar').hasClass('header-searchbar-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);
            }
            if ($('body').hasClass('mahalo-trending-news-active')) {
                $('.trending-news-main-wrap').slideToggle();
                $('body').toggleClass('mahalo-trending-news-active');
                $('.navbar-control-trending-news').focus();
            }
        }
    });
    // Action On Esc Button
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);
            }
        }
    });
    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    // Offcanvas Close
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);
    });
    // Offcanvas Close
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    // Offcanvas re focus on close button
    $('input, a, button').on('focus', function () {
        if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {
            if ($(this).hasClass('skip-link-off-canvas')) {
                if (!$("#offcanvas-menu #social-nav-offcanvas").length == 0) {
                    $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();
                } else if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
                    $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
                }
            }
        }
    });
    $('.skip-link-offcanvas').focus(function () {
        $(".button-offcanvas-close").focus();
    });

    // Sidr WidgetArea

    if ($("body").hasClass("rtl")) {
        $('#widgets-nav').sidr({
            name: 'sidr-nav',
            side: 'right'
        });
    } else {
        $('#widgets-nav').sidr({
            name: 'sidr-nav',
            side: 'left'
        });
    }
    $('#hamburger-one').click(function () {
        $(this).toggleClass('active');

        if(  $(this).hasClass('active') ){
            $('body').addClass('body-scroll-locked');
        }else{
            $('body').removeClass('body-scroll-locked');
        }

        setTimeout(function () {
            $('.sidr-offcanvas-close').focus();
        }, 300);

    });
    $('.sidr-offcanvas-close').click(function () {

        $.sidr('close', 'sidr-nav');

        $('#hamburger-one').removeClass('active');

        $('body').removeClass('body-scroll-locked');

        setTimeout(function () {
            $('#hamburger-one').focus();
        }, 300);

    });
    $( 'input, a, button' ).on( 'focus', function() {
        if ( $( 'body' ).hasClass( 'sidr-nav-open' ) ) {

            if ( $( this ).hasClass( 'skip-link-offcanvas-first' ) ) {
                $('.skip-link-offcanvas-last').focus();
            }

            if ( ! $( this ).parents( '#sidr-nav' ).length ) {
                $('.sidr-offcanvas-close').focus();
            }
        }
    } );

    $(document).keyup(function (j) {
        if( $('body').hasClass('sidr-nav-open') ){

            if (j.key === "Escape") { // escape key maps to keycode `27`

                $.sidr('close', 'sidr-nav');
                $('#hamburger-one').removeClass('active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('#hamburger-one').focus();
                }, 300);

            }
        }
    });

    // Trending News Start
    $('.navbar-control-trending-news').click(function () {
        $('.trending-news-main-wrap').slideToggle();
        $('body').toggleClass('mahalo-trending-news-active');
        $('#trending-collapse').focus();
    });
    $('.mahalo-skip-link-end').focus(function () {
        $('#trending-collapse').focus();
    });
    $('.mahalo-skip-link-start').focus(function () {
        $('.trending-news-main-wrap .column:last-child .entry-meta a').focus();
    });
    $('#trending-collapse').click(function () {
        $('.trending-news-main-wrap').slideToggle();
        $('body').toggleClass('mahalo-trending-news-active');
        $('.navbar-control-trending-news').focus();
    });
    // Trending News End
    var rtled = false;
    if ($('body').hasClass('rtl')) {
        rtled = true;
    }
    // Single Post content gallery slide
    $("figure.wp-block-gallery.has-nested-images.columns-1, .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .gallery-columns-1").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">' + mahalo_custom.next_svg + '</button>',
            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">' + mahalo_custom.prev_svg + '</button>',
            dots: false,
            rtl: rtled
        });
    });

    $(function() {
        $('#theme-banner-navs a').click(function() {
            // Check for active
            $('#theme-banner-navs li').removeClass('active');
            $(this).parent().addClass('active');
            // Display active tab
            let currentTab = $(this).attr('href');
            $('.main-banner-right .twp-banner-tab').hide();
            $(currentTab).show();
            return false;
        });
    });
    // Content Gallery popup End
    $(".theme-default-slide").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.default-slider-wrapper').find('.slide-prev-default'),
            nextArrow: $(this).closest('.default-slider-wrapper').find('.slide-next-default'),
            dots: false,
        });
    });

    $(".main-slider-container").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            asNavFor: ".main-slider-pagination",
            autoplay: true,
            speed: 900,
            autoplaySpeed: 6000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: true,
                        nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">' + mahalo_custom.next_svg + '</button>',
                        prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">' + mahalo_custom.prev_svg + '</button>',
                    }
                }
            ]
        });
    });
    $(".main-slider-pagination").each(function () {
        $(this).slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: ".main-slider-container",
            focusOnSelect: true,

            arrows: false,

            autoplay: true,
            vertical: true,

            verticalSwiping: true,
            autoplaySpeed: 10000,
            infinite: true,
            centerMode: true,
            centerPadding: "1px",
        });
    });

    $(window).on('resize orientationchange', function() {
        $('.main-slider-pagination').slick('refresh');
    });

    $(".theme-slider-block").each(function () {
            $(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: false,
                autoplaySpeed: 8000,
                infinite: true,
                prevArrow: $(this).closest('.theme-block-navtabs').find('.slide-prev-lead'),
                nextArrow: $(this).closest('.theme-block-navtabs').find('.slide-next-lead'),
                dots: false,
            });
        });

    $(".theme-tiles-slide").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-block-tiles').find('.slide-prev-tiles'),
            nextArrow: $(this).closest('.theme-block-tiles').find('.slide-next-tiles'),
            dots: false,
        });
    });
    // Banner Block 1
    $(".theme-widget-slider").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">' + mahalo_custom.next_svg + '</button>',
            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">' + mahalo_custom.prev_svg + '</button>',
            dots: false,
        });
    });

    $(".theme-widget-carousel").each(function () {
        $(this).slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            infinite: true,
            prevArrow: $(this).closest('.widget-layout-carousel').find('.slide-widget-prev'),
            nextArrow: $(this).closest('.widget-layout-carousel').find('.slide-widget-next'),
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: false
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

    $( '#theme-video-slider' ).sliderPro({
        width: 950,
        height: 480,
        orientation: "vertical",
        loop: false,
        arrows: true,
        buttons: false,
        thumbnailsPosition: "right",
        thumbnailPointer: true,
        thumbnailWidth: 380,
        thumbnailHeight: 160,
        breakpoints: {
            1400: {
                height: 400,
            },
            1200: {
                thumbnailsPosition: "bottom",
            },
            800: {
                thumbnailsPosition: "bottom",
                thumbnailWidth: 270,
                thumbnailHeight: 100,
            },
            500: {
                thumbnailsPosition: "bottom",
                thumbnailWidth: 120,
                thumbnailHeight: 50,
            },
        },
    });

    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });
    $(window).scroll(function () {
        if ($(window).scrollTop() > $(window).height() / 2) {
            $(".scroll-up").fadeIn(300);
        } else {
            $(".scroll-up").fadeOut(300);
        }
    });

    var tc = $( ".theme-ticker-area" );

    if( tc.length ) {
        var tcM = tc.find( ".ticker-slides" ).marquee({
            delayBeforeStart: 0,
            duration: 25000,
            pauseOnHover: true,
            duplicated: true,
            startVisible: true,
            gap: 0,
        });
        tc.on( "click", ".ticker-controls-btn", function() {
            $(this).find( "span" ).toggleClass( "ticker-controls-pause ticker-controls-play" )
            tcM.marquee( "toggle" );
        });
    }

    // Scroll to Top on Click
    $('.scroll-up').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });

    // Widgets Tab
    $('.twp-nav-tabs .tab').on('click', function (event) {
        var tabid = $(this).attr('tab-data');
        $(this).closest('.tabbed-container').find('.tab').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabbed-container').find('.tab-content .tab-pane').removeClass('active');
        $(this).closest('.tabbed-container').find('.content-' + tabid).addClass('active');

    });
});

jQuery(document).ready(function ($) {

    // Here You can type your custom JavaScript...

    var header = document.getElementById("theme-navigation");
    if (header) {
        window.onscroll = function () {
            myFunction()
        };
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("theme-navbar-affix");
            } else {
                header.classList.remove("theme-navbar-affix");
            }
        }
    }

});

jQuery(document).ready(function ($) {

    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('#theme-navigation').outerHeight();

    $(window).on('scroll', function (event) {
        didScroll = true;
    });

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $('#theme-navigation').removeClass('navbar-affix-down').addClass('navbar-affix-up');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('#theme-navigation').removeClass('navbar-affix-up').addClass('navbar-affix-down');
            }
        }

        lastScrollTop = st;
    }

});