$(function() {
    'use strict';
    var cubeObj = {};

    // Slider
    cubeObj.slider = function() {
        var $sliderNode = $('.slider');
        var $topEventsSLider = $('.top-events-sliders');

        $sliderNode.slick({
            // slidesToShow: 1,
            fade: true,
            // autoplay: true,
            autoplaySpeed: 2000,
            draggable: true,
            speed: 1000
        });

        $topEventsSLider.slick({
            slidesToShow: 1,
            fade: true,
            dots: true,
            arrows: false,
            easing: 'easeInExpo',
            autoplay: false,
            draggable: false,
            speed: 900,
            swipe: false
        });
        // $('.top-events-sliders').bxSlider({mode: 'fade', controls:false, preloadImages:'all'});

        // Full height sluder images
        function fullHeightSlides() {
            var $imgSlider = $('.slider .container-fluidss img.img-responsive');
            var $defaildSlider = $('.slider-default .container-fluidss img.img-responsive');
            var windowHeight = $(window).height();
            var windowWidth = $(window).width();


            function count(node) {
                if ((windowHeight > windowWidth) && ($('.slider').length)) {
                    $(node).removeClass('img-responsive').addClass('height-to-window');
                };
                if ((windowHeight < windowWidth) && ($('.slider').length)) {
                    // $(this).removeClass('height-to-window').addClass('img-responsive');
                    $(node).removeClass('img-responsive').addClass('height-to-window');
                };
                if ((windowWidth < 1200) && ($('.slider-default').length)) {
                    $(node).removeClass('img-responsive').addClass('height-to-window');
                };
            };

            $imgSlider.each(function() {
                var node = this;
                count(node);
            });
            $defaildSlider.each(function() {
                var node = this;
                count(node);
            });

        };

        $(window).resize(function() {
            fullHeightSlides();
        });
        fullHeightSlides();

    };

    cubeObj.videoImgResponsive = function() {

        function runResize() {
            var $vidImages = $('.img-fit');
            var $iframe = $('.video-bg');
            var $vidIframeContainer = $('.video-bg').closest('.container-fluidss');

            $vidImages.each(function() {
                //If the screen width is wider than height
                if (($(window).innerWidth() > $(window).innerHeight())) {
                    $(this).css('width', $(window).innerWidth());
                    $(this).css('height', 'auto');
                    $(this).css('top', -($(this).height() - $(window).innerHeight()) / 2);
                    $(this).css('left', 0);
                } else
                //If the screen height is heiger than it's width
                if (($(window).innerWidth() < $(window).innerHeight())) {
                    $(this).css('height', $(window).innerHeight());
                    $(this).css('width', 'auto');
                    $(this).css('top', 0);
                    var leftPadding = ($(this).width() - $(window).innerWidth()) / 2;
                    console.log($(this), leftPadding, $(this).width(), $(window).innerWidth());
                    $(this).css('left', -leftPadding);
                    //If th      
                } else {
                    $(this).css('left', 'auto');
                    $(this).css('height', 'auto');
                };
                $vidIframeContainer.height($(window).innerHeight());
            });

            $iframe.each(function() {
                $(this).width($(window).innerWidth() - 10);
            });
        };

        runResize();

        $(window).resize(function() {
            runResize();
        });
    },

    // Scroller 
    cubeObj.scrollAtOnce = function() {
        var $sliderDiv = $('.slider');
        var scrollDirection = '';
        var $slider = $('.slider');
        var $topEvents = $('.top-events');
        var $gallery = $('.gallery.sect');
        var $sect = $('.blog.sect');
        var $windowHeight = $(window).height();
        var self = this;
        var scrollTopValue = 0;
        var scrollToogle = false;
        var mobileScrollFlag = false;


        // Defailt div positions if slider is non visible
        function setDefaultPositions() {
            $slider.css({
                zIndex: 11
            });
            $topEvents.css({
                position: 'fixed',
                width: '100%',
                top: 0,
                left: 0
            });
            $gallery.css({
                position: 'fixed',
                width: '100%',
                top: $('.top-events').outerHeight(),
                left: 0
            });
            $sect.css({
                marginTop: $('.top-events').outerHeight() + $gallery.outerHeight()
            });
        };

        // Custom div positions if slider is visible
        function setCustomPositions() {
            $topEvents.css({
                position: 'relative'
            });
            $gallery.css({
                position: 'relative'
            });
            $gallery.css({
                top: 0
            });
            $sect.css({
                marginTop: 0
            });

        };

        if ($(document).scrollTop() === 0) {
            setDefaultPositions();
        };

        // Append to scrollbar dragg
        $(window).scroll(function() {
            var _scrollValue = $(window).scrollTop();

            if (($(window).scrollTop() >= $slider.outerHeight()) && (_scrollValue > scrollTopValue) && (scrollToogle === false)) {
                scrollToogle = true;
                setCustomPositions();
                // Pause slider
                $('.slider').slickPause();


            } else if (($(window).scrollTop() <= $slider.outerHeight()) && (_scrollValue < scrollTopValue) && (scrollToogle === true)) {
                scrollToogle = false;
                setDefaultPositions();

                // Autoplay slider
                $('.slider').slickPlay();
            };
            scrollTopValue = _scrollValue;

        });

        $(document.body).on('DOMMouseScroll mousewheel', function(event) {
            if (event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0) {
                scrollDirection = 'down';
            } else {
                scrollDirection = 'up';
            };
            if (($(document).scrollTop() === 0) && (scrollDirection === 'down')) {
                $('html,body').stop().animate({
                    scrollTop: $(window).height()
                }, 600);

                $(window).bind('DOMMouseScroll mousewheel', function(event) {
                    event.preventDefault();
                });
                setTimeout(function() {
                    setCustomPositions();
                    $(window).unbind('DOMMouseScroll mousewheel');
                }, 600);

                // Pause slider
                $('.slider').slickPause();
                scrollToogle = true;
                return false;

            } else if (($(document).scrollTop() <= ($slider.height())) && (scrollDirection === 'up')) {
                setDefaultPositions();
                $('.datepicker').hide();
                $(window).bind('DOMMouseScroll mousewheel', function(event) {
                    event.preventDefault();
                });

                // Unbind scroll disable
                setTimeout(function() {
                    $(window).unbind('DOMMouseScroll mousewheel');
                }, 600);
                $('html,body').stop().animate({
                    scrollTop: 0
                }, 600);

                // Autoplay slider
                $('.slider').slickPlay();
                scrollToogle = false;
                return false;
            };
        });

        document.body.addEventListener('touchmove', function(event) {


            if (($(document).scrollTop() < $slider.height())) {
                console.log('Animate');
                // scrollDirection = 'up';
            };
        });
    };

    // Calendar
    cubeObj.calendar = function() {
        var currDate = new Date();
        var setDate = (currDate.getMonth() + 1) + '-' + currDate.getDate() + '-' + currDate.getFullYear();
        $('.input-datepicker').attr('value', setDate);
        $('#dp').attr('data-date', setDate);

        $('#dp').datepicker({
            format: 'mm-dd-yyyy',
            startDate: '-15d',
            autoclose: true,
            endDate: '+0d',
            todayHighlight: true,
            weekStart: 1,
        });
    };


    // Header to top
    cubeObj.headerToTop = function() {
        function headToTop() {
            var $headerTop = $('.header-top');
            var headerScroll = $headerTop.offset();
            var headerScrollTop = headerScroll.top;
            var windowHeight = $(window).outerHeight();

            if ($(window).scrollTop() >= windowHeight) {
                $headerTop.css('position', 'fixed');
                $headerTop.css('top', '0');
            };

            $(document).scroll(function() {
                if ($(this).scrollTop() >= headerScroll.top) {
                    $headerTop.css('position', 'fixed');
                    $headerTop.css('top', '0');
                } else {
                    $headerTop.css('position', 'absolute');
                    $headerTop.css('top', '0');
                };
            });
        };

        headToTop();
        $(window).resize(function() {
            headToTop();
        });
    };


    // Full height slider text
    cubeObj.fullHeightSLider = function() {
        function resizeSliderHeight() {
            var $rows = $('.rowss');
            var slideNodeHeight = $rows.height();
            var windowHeight = document.body.clientHeight;
            var windowWidth = document.body.clientWidth;
            var sliderHeight = $('.slider-default').height() || $('.slider').height();
            var $slideClick = $('.slick-prev');
            var $slideClickNext = $('.slick-next');
            var slideClickHeight = $slideClick.height();
            var slideClickTop = (sliderHeight - slideClickHeight) / 2;
            var sliderTopPadding = (sliderHeight - slideNodeHeight) / 2;

            $slideClick.css('top', slideClickTop);
            $slideClickNext.css('top', slideClickTop);

            console.log(slideNodeHeight, windowHeight);

            if ((slideNodeHeight < sliderHeight) && ($('.slider').length)) {
                $rows.css('top', sliderTopPadding + 40);
            } else if ((slideNodeHeight < sliderHeight) && ($('.slider-default').length)) {
                 $rows.css('top', sliderTopPadding + 10);
            } else {
                $rows.css('top', '140px');
            };

            if ((slideNodeHeight < sliderHeight) && (window.devicePixelRatio === 2) && ((windowWidth) === 1024)) {
                $rows.css('top', ((sliderHeight / 2 - slideNodeHeight)) + 40);
            };


            if (slideNodeHeight > $(window).outerHeight()) {
                console.log($(window).outerHeight(), slideNodeHeight);
            };
        };

        resizeSliderHeight();
        $(window).resize(function() {
            resizeSliderHeight();
            console.log('Resized titles top')
        });
    };


    // ScrollBar in Top Events
    cubeObj.perfectScrollBar = function() {
        // $(".poput-evt-inner").perfectScrollbar({
        //     wheelSpeed: 20,
        //     wheelPropagation: true,
        //     minScrollbarLength: 20,
        //     suppressScrollX: true,
        //     scrollYMarginOffset: 2,
        //     includePadding: true
        // });
        // $(".poput-evt-inner").scroller();
        // $('.poput-evt-inner').perfectScrollbar({suppressScrollX:true, wheelPropagation: true});

    };


    cubeObj.customScroll = function() {
        var $slider = $('.slider');
        var $topEvents = $('.top-events.sect');
        var $gallery = $('.gallery.sect');
        var $windowHeight = $(window).height();

        $slider.css({
            zIndex: 11
        });
        $topEvents.css({
            position: 'fixed',
            width: '100%',
            top: 0,
            left: 0
        });
        $gallery.css({
            paddingTop: $windowHeight
        });

        function reverseDiv() {
            $(document.body).on('DOMMouseScroll mousewheel', function(e) {
                if ($(document).scrollTop() > $slider.height()) {
                    $topEvents.css({
                        position: 'relative'
                    });
                    $gallery.css({
                        paddingTop: 0
                    });
                } else {
                    $topEvents.css({
                        position: 'fixed',
                        width: '100%',
                        top: 0,
                        left: 0
                    });
                    $gallery.css({
                        paddingTop: $windowHeight
                    });
                };
            });
        };
        reverseDiv();
    };


    // Validate Email
    cubeObj.validateEmail = function() {
        var $emailInput = $('#email-subscribe');
        var $subscribeBtn = $('#subscribe-btn');
        var $EmailFooterForm = $('#email-footer-form');
        var regEmail = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        var nodesToInsert = '<div class="popup-error"><div class="popup-error-inner"><div class="corner-error"></div><span class="popup-error-title"></span></div>';

        $EmailFooterForm.submit(function(event) {
            $('#email-footer-form>.popup-error').remove();
            if ($emailInput.val() === '') {
                event.preventDefault();
                $EmailFooterForm.prepend('<div class="popup-error"><div class="popup-error-inner"><div class="corner-error"></div><span class="popup-error-title">' + 'Enter Email' + '</span></div>');
            } else if (regEmail.test($emailInput.val()) === false) {
                event.preventDefault();
                $EmailFooterForm.prepend('<div class="popup-error"><div class="popup-error-inner"><div class="corner-error"></div><span class="popup-error-title">' + 'Enter valid Email' + '</span></div>');
            };
        });
    };

    cubeObj.addVideos = function() {
        var $iframes = $('.video-bg');
        $iframes.width(window.innerWidth);
        $iframes.height((window.innerWidth / 16) * 9);
        // $(window).resize(function() {
        //     cubeObj.addVideos();
        // });
    };
    //Button hider
    cubeObj.btnToogle = function() {
        var $btnHider = $('.btn-dropdown').find('.col-right-btn');

        $btnHider.on('touchstart click', function(event) {
            var $hidedDive = $(event.target).closest('.btn-dropdown').find('.hidden-dv');
            if ($hidedDive.css('display') === 'none') {
                $hidedDive.show();
            } else {
                $hidedDive.hide();
            };
        });

        //Prevent toogle menu to clicking
        $('.dropdown-toggle').on('click touchstart', function(event) {
            event.preventDefault();
        });
    },

    //Responsive images
    cubeObj.responsiveImg = function() {

        function resizeResponsiveImg() {
            var $imgContainers = $('.img-contain');

            $imgContainers.each(function() {
                var $imgContainer = $(this);
                var $imgInner = $imgContainer.find('img');

                if ($imgInner.height() < $imgContainer.height()) {
                    $imgInner.removeClass('img-responsive').addClass('height-to-window');
                } else {
                    $imgInner.removeClass('height-to-window').addClass('img-responsive');
                }
            });
        };
        resizeResponsiveImg();
        $(window).resize(function() {
            resizeResponsiveImg();
        });
    },
    cubeObj.ticketEventAnimate = function() {
        var $tickets = $('.ticket-event');

        if ($tickets.length > 0) {

            $('.ticket-event').mouseenter(function() {
                var width = $(this).find('.ticket-event-lineup').width();
                var outerWidth = $(this).find('.ticket-event-lineup').outerWidth();
                var $shNode = $(this).find('.ticket-line-up.sh');
                var $hdNode = $(this).find('.ticket-line-up.hid');

                $shNode.stop();
                $hdNode.stop();
                $shNode.width(width);
                $hdNode.width(width);

                $shNode.animate({
                    left: -outerWidth
                }, 500);

                $hdNode.animate({
                    left: 0
                }, 500);
            });
            $('.ticket-event').mouseleave(function() {
                var width = $(this).find('.ticket-event-lineup').outerWidth();
                var $shNode = $(this).find('.ticket-line-up.sh');
                var $hdNode = $(this).find('.ticket-line-up.hid');

                $shNode.stop();
                $hdNode.stop();
                $shNode.animate({
                    left: 0
                }, 500);

                $hdNode.animate({
                    left: outerWidth
                }, 500);
            });
        };
    };

    cubeObj.defaults = function() {
        if ($('.slider-default').length > 0) {
            $('.slider-default').slick({
                slidesToShow: 1,
                fade: true,
                dots: true,
                easing: 'easeInExpo',
                // autoplay: true,
                // autoplaySpeed: 4200,
                draggable: false,
                speed: 1000
            });
            $('.datepicker.dropdown-menu').addClass('whity');
            $('.default-slider-tickets').slick({
                slidesToShow: 1,
                dots: true,
                easing: 'easeInExpo',
                autoplay: false,
                autoplaySpeed: 4200,
                draggable: false,
                speed: 800,
                vertical: true
            });
            $('.default-gallery-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                // fade: true,
                easing: 'easeOutExpo',
                infinite: false,
                autoplay: false,
                draggable: false,
                speed: 800
            });
            $('.gall-slide-right').click(function() {
                $('.default-gallery-slider').slickNext();
            });
            $('.gall-slide-prev').click(function() {
                $('.default-gallery-slider').slickPrev();
            });
        };
    };
    // Init
    cubeObj.init = function() {
        if ($('.slider').length) {
            this.slider();
            this.scrollAtOnce();
            this.headerToTop();
            this.fullHeightSLider();
        };
        if ($('.slider-default').length) {
            this.slider();
            this.fullHeightSLider();
        };
        this.calendar();
        this.perfectScrollBar();
        this.validateEmail();
        this.addVideos();
        this.ticketEventAnimate();
        this.btnToogle();
        this.responsiveImg();
        this.videoImgResponsive();
        this.defaults();
    };

    cubeObj.init();
});



// Youtube
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player = [];
var ids = [];

function onYouTubeIframeAPIReady() {
    $('.video-bg').each(function() {
        ids.push(this.id);
    });
    for (var j = 0; j < ids.length; j++) {
        if (ids[j]) {
            player[j] = new YT.Player(ids[j], {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            })
        };
    };
};

function onPlayerReady(event) {
    var _eventTarget = event.target;
    var _iframe = event.target.a;
    var $playBtn = $(_iframe).closest('.container-fluidss').find('.video-btn').find('.left-btn');
    var $titles = $(_iframe).closest('.container-fluidss').find('.rowss');
    var $pattern = $(_iframe).closest('.container-fluidss').find('.pattern');
    var $bgImg = $(_iframe).closest('.container-fluidss').find('.vid');
    var $slickPrev = $('.slick-prev');
    var $slickNext = $('.slick-next');
    var videoOnOff = false;

    function hideControls() {
        $titles.fadeOut();
        $slickPrev.fadeOut();
        $slickNext.fadeOut();
        $bgImg.fadeOut();
    };

    function showControls() {
        $titles.fadeIn();
        $slickPrev.fadeIn();
        $slickNext.fadeIn();
        $bgImg.fadeIn();
    };

    $playBtn.on('click touchstart', function() {
        $('.slider').slickPause();
        console.log('Play!', _eventTarget);
        _eventTarget.playVideo();
        setTimeout(function() {
            hideControls();
        }, 100);
        videoOnOff = false;

        $pattern.on('click touchstart', function() {
            _eventTarget.pauseVideo();
            showControls();
            setTimeout(function() {
                $('.slider').slickPlay();
            }, 3000);
            videoOnOff = true;
        });

        $(window).scroll(function() {
            if (($(document).scrollTop() >= $(window).height()) && (videoOnOff === false)) {
                videoOnOff = true;
                _eventTarget.pauseVideo();
                showControls();
            };
        });
    });
    $pattern.off('click touchstart');
    $('.slider').slickPlay();
};

function onPlayerStateChange(event) {
    var _eventTarget = event.target;
    var _iframe = event.target.a;
    var $playBtn = $(_iframe).closest('.container-fluidss').find('.rnd-inner');
    var $titles = $(_iframe).closest('.container-fluidss').find('.rowss');
    var $pattern = $(_iframe).closest('.container-fluidss').find('.pattern');
    var $bgImg = $(_iframe).closest('.container-fluidss').find('.vid');
    var $slickPrev = $('.slick-prev');
    var $slickNext = $('.slick-next');

    function showControls() {
        $titles.fadeIn();
        $slickPrev.fadeIn();
        $slickNext.fadeIn();
        $bgImg.fadeIn();
    };

    if (event.data === 0) {
        showControls();
        setTimeout(function() {
            $('.slider').slickPlay();
        }, 3000);
    };
};