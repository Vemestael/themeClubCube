$(function() {
    'use strict';
    var cubeObj = {};

    cubeObj.fullHeightSlides = function() {
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

    // Fullscreen Slider
    cubeObj.slider = function() {
        var $sliderNode = $('.slider');
        var $topEventsSLider = $('.top-events-sliders');
        window.tileSlide = new TileSlide(document.querySelector('.slider'));
        // $sliderNode.slick({
        //     // slidesToShow: 1,
        //     // fade: true,
        //     // autoplay: false,
        //     autoplaySpeed: 200000,
        //     // draggable: true,
        //     speed: 1000
        // });

        //Bind Tile Slide
        // if (document.querySelector('.slider')) {
        //     var tileSlide = new TileSlide(document.querySelector('.slider'));
        // };

        // if (document.querySelector('.slider-default')) {
        //     var defaultTileSlide = new TileSlide(document.querySelector('.slider-default'));
        // };
        $topEventsSLider.slick({
            slidesToShow: 1,
            fade: true,
            dots: true,
            arrows: false,
            easing: 'easeInExpo',
            // autoplay: false,
            draggable: false,
            speed: 900,
            swipe: false
        });


        // Full height sluder images
        // function fullHeightSlides() {
        //     var $imgSlider = $('.slider .container-fluidss img.img-responsive');
        //     var $defaildSlider = $('.slider-default .container-fluidss img.img-responsive');
        //     var windowHeight = $(window).height();
        //     var windowWidth = $(window).width();

        //     function count(node) {
        //         if ((windowHeight > windowWidth) && ($('.slider').length)) {
        //             $(node).removeClass('img-responsive').addClass('height-to-window');
        //         };
        //         if ((windowHeight < windowWidth) && ($('.slider').length)) {
        //             $(node).removeClass('img-responsive').addClass('height-to-window');
        //         };
        //         if ((windowWidth < 1200) && ($('.slider-default').length)) {
        //             $(node).removeClass('img-responsive').addClass('height-to-window');
        //         };
        //     };
        //     $imgSlider.each(function() {
        //         var node = this;
        //         count(node);
        //     });
        //     $defaildSlider.each(function() {
        //         var node = this;
        //         count(node);
        //     });
        // };
        // $(window).resize(function() {
        //     fullHeightSlides();
        // });
        // fullHeightSlides();
        this.fullHeightSlides();
    };

    //Defaul slider page
    cubeObj.defaultSlider = function() {
        var $sliderNode = $('.slider');
        var $topEventsSLider = $('.top-events-sliders');
        window.tileSlide = new TileSlide(document.querySelector('.slider-default'), {
            dots: true
        });
        this.fullHeightSlides();
    };

    cubeObj.partnersSlider = function() {
        //Slider for partners
        function partnerSlider() {
            if (window.innerWidth < 768) {
                $('.partners-slider').slick({
                    dots: false,
                    infinite: false,
                    speed: 400,
                    slidesToShow: 1,
                    touchMove: false,
                    slidesToScroll: 1
                });
            } else {
                $('.partners-slider').slick({
                    dots: false,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 5,
                    touchMove: false,
                    slidesToScroll: 1
                });
            };
        };
        $(window).resize(function() {
            partnerSlider();
        });
        partnerSlider();
    };

    //
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
                    $(this).css('left', -leftPadding);
                } else {
                    $(this).css('left', 'auto');
                    $(this).css('height', 'auto');
                };
                if (($(window).innerWidth() < 768) && ($(window).innerWidth() > 1200)) {
                    $vidIframeContainer.height($(window).innerHeight());
                };
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
        var $scrollDownButt = $('.scroll-down');
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

        //Scroll down button event
        $scrollDownButt.on('click', function() {
            scrollToogle = true;

            $('html,body').stop().animate({
                scrollTop: $(window).height()
            }, 600);

            tileSlide.stopSlide();
            setTimeout(function() {
                setCustomPositions();
                $('header').addClass('header-top active');
                $(window).unbind('DOMMouseScroll mousewheel');
            }, 600);
        });

        // Append to scrollbar dragg
        $(window).scroll(function() {
            var _scrollValue = $(window).scrollTop();
            if (($(window).scrollTop() >= $slider.outerHeight()) && (_scrollValue > scrollTopValue) && (scrollToogle === false)) {
                scrollToogle = true;
                setCustomPositions();
                $('header').addClass('header-top active');
                // Pause slider
                // $('.slider').slickPause();
                tileSlide.stopSlide();
            } else if (($(window).scrollTop() <= $slider.outerHeight()) && (_scrollValue < scrollTopValue) && (scrollToogle === true)) {
                scrollToogle = false;
                setDefaultPositions();
                $('header').removeClass('header-top active');
                // Autoplay slider
                // $('.slider').slickPlay();
                tileSlide.playSlide();
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
                    $('header').addClass('header-top active');
                    $(window).unbind('DOMMouseScroll mousewheel');
                }, 600);

                // Pause slider
                // $('.slider').slickPause();
                tileSlide.stopSlide();
                scrollToogle = true;
                return false;
            } else if (($(document).scrollTop() <= ($slider.height())) && (scrollDirection === 'up')) {
                setDefaultPositions();
                $('header').removeClass('header-top active');
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
                // $('.slider').slickPlay();
                tileSlide.playSlide();
                scrollToogle = false;
                return false;
            };
        });
        document.body.addEventListener('touchmove', function(event) {
            if (($(document).scrollTop() < $slider.height())) {
                // scrollDirection = 'up';
            };
        });
    };

    // Calendar
    cubeObj.calendar = function() {
        var currDate = new Date();
        var setDate = (currDate.getMonth() + 1) + '-' + currDate.getDate() + '-' + currDate.getFullYear();
        $('.input-datepicker').attr('value', setDate);
        $('.dp').attr('data-date', setDate);
        $('.dp').datepicker({
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
            var $header = $('header');
            var $headerParent = $('header').parent();
            var $sliderDefault = $('.slider-default');
            var headerParentHeight = $headerParent.height();

            if ($sliderDefault.length) {
                if ($(window).scrollTop() >= $sliderDefault.height()) {
                    $header.addClass('header-top');
                };
            } else if ($(window).scrollTop() >= headerParentHeight) {
                $header.addClass('header-top');
            };
            $(document).scroll(function() {
                if ($sliderDefault.length) {
                    if ($(window).scrollTop() >= $sliderDefault.height()) {
                        $header.addClass('header-top active');
                    } else {
                        $header.removeClass('header-top active');
                    }
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
            var slideClickTop = (window.innerHeight - slideClickHeight) / 2;
            var sliderTopPadding = (sliderHeight - slideNodeHeight) / 2;

            // $slideClick.css('top', slideClickTop);
            // $slideClickNext.css('top', slideClickTop);
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
            // if (slideNodeHeight > $(window).outerHeight()) {
            //     console.log($(window).outerHeight(), slideNodeHeight);
            // };
        };
        resizeSliderHeight();
        $(window).resize(function() {
            resizeSliderHeight();
        });
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

    //Fullscreen Iframe sizing
    cubeObj.addVideos = function() {
        var $iframes = $('.video-bg');
        if (window.innerWidth > window.innerHeight) {
            $iframes.width(document.body.clientWidth);
            $iframes.height((document.body.clientWidth / 1.77) + 40);
            // $iframes.height((window.innerWidth / 1.77));
        } else {
            $iframes.width(window.innerWidth);
            $iframes.height(window.innerHeight + 40);
        };
        $(window).resize(function() {
            cubeObj.addVideos();
        });
    };

    //Default slider Iframe sizing
    cubeObj.addVideosDefault = function() {
        var $iframes = $('.video-bg.default');
        var $iframeContainer = $iframes.closest('.container-fluidss');
        if (window.innerWidth > $iframeContainer.height()) {
            $iframes.width(window.innerWidth);
            $iframes.height(window.innerWidth / 1.77);
        } else {
            $iframes.width(window.innerWidth);
            $iframes.height($iframeContainer.height());
        };
        // $iframes.width(window.innerWidth);
        // $iframes.height(window.innerHeight);
        // $iframes.height((window.innerWidth / 16) * 9);
        $(window).resize(function() {
            cubeObj.addVideosDefault();
        });
    };

    //Button hider
    cubeObj.btnToogle = function() {
        var $btnHider = $('.button-dropdown');
        $btnHider.on('touchstart touchend click', function(event) {
            event.preventDefault();
            console.log('clicked');
            var $hidedDive = $(event.target).find('.hidden-dv');
            if ($hidedDive.hasClass('hide')) {
                // $hidedDive.show();
                $hidedDive.removeClass('hide');
                $hidedDive.addClass('show');
            } else {
                // $hidedDive.hide();
                $hidedDive.removeClass('show');
                $hidedDive.addClass('hide');
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
    };


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
        // if ($('.slider-default').length > 0) {
        //     $('.slider-default').slick({
        //         slidesToShow: 1,
        //         fade: true,
        //         dots: true,
        //         easing: 'easeInExpo',
        //         autoplay: false,
        //         autoplaySpeed: 4200,
        //         draggable: false,
        //         speed: 1000
        //     });

        // if (document.querySelector('.slider')) {
        //     window.tileSlide = new TileSlide(document.querySelector('.slider'));
        // };
        // if (document.querySelector('.slider-default')) {
        //     window.defaultTileSlide = new TileSlide(document.querySelector('.slider-default'));
        // };
        // $('.datepicker.dropdown-menu').addClass('whity');
        $('.default-slider-tickets').slick({
            slidesToShow: 1,
            dots: true,
            easing: 'easeInExpo',
            autoplay: false,
            autoplaySpeed: 4200,
            draggable: false,
            speed: 300,
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
            speed: 300
        });
    };


    //Event view
    cubeObj.eventView = function() {
        function leftAsider() {
            var $mainContent = $('.text-contain');
            var leftMargin = ((window.innerWidth - 1170) / 2) + 772;
            var $aside = $('.absi');
            $aside.css('left', leftMargin);
        };
        $(window).resize(function() {
            leftAsider();
        });
        leftAsider();
    };

    //Events list page
    cubeObj.eventsList = function() {
        var currDate = new Date();
        var setDate = (currDate.getMonth() + 1) + '-' + currDate.getDate() + '-' + currDate.getFullYear();
        $('.input-datepicker').attr('value', setDate);
        $('#dp').attr('data-date', setDate);

        var picker = $('#dp').datepicker({
            format: 'mm-dd-yyyy',
            startDate: '-15d',
            autoclose: true,
            endDate: '+0d',
            todayHighlight: true,
            weekStart: 1
        });

        $('.events-tile-datapicker').append($('.datepicker.dropdown-menu'));
        // $('.events-tile-datapicker').append($('<div class="mutable"></div>'));
    };

    //Events Tile page
    cubeObj.eventsTile = function() {
        var currDate = new Date();
        var setDate = (currDate.getMonth() + 1) + '-' + currDate.getDate() + '-' + currDate.getFullYear();
        $('.input-datepicker').attr('value', setDate);
        $('#dp').attr('data-date', setDate);
        var picker = $('#dp').datepicker({
            format: 'mm-dd-yyyy',
            startDate: '-15d',
            autoclose: true,
            endDate: '+0d',
            todayHighlight: true,
            weekStart: 1
        });
        $('.events-tile-datapicker').append($('.datepicker.dropdown-menu'));
        $('.events-tile-datapicker>.datepicker.dropdown-menu').click(function() {
            $(this).parent().addClass('ov-vis');
            $('.datepicker.dropdown-menu').addClass('active');
        });
        $('body').click(function() {
            if ($('.events-tile-datapicker').hasClass('ov-vis')) {
                $('.events-tile-datapicker').removeClass('ov-vis');
                $('.datepicker.dropdown-menu').removeClass('active');
            };
        });

        //Bootstrap tabs
        var currentTabNumber = 0;
        var $tabsArray = $('#weeks-tab a');
        var $leftNode = $('.paging .event-dates.pull-left');
        var $rightNode = $('.paging .event-dates.pull-right');;

        function bootstrapTabs() {
            function findPressedTabNumber(pressedTab) {
                for (var i = 0; i < 4; i++) {
                    if (pressedTab === $tabsArray[i]) {
                        currentTabNumber = i;
                    };
                };
            };
            $('#weeks-tab a').on('click touchstart', function(event) {
                event.preventDefault();
                findPressedTabNumber(this);
                if (currentTabNumber === 0) {
                    $leftNode.addClass('off');
                    $rightNode.removeClass('off');
                } else if (currentTabNumber === 3) {
                    $rightNode.addClass('off');
                    $leftNode.removeClass('off');
                } else {
                    $leftNode.removeClass('off');
                    $rightNode.removeClass('off');
                };
                $(this).tab('show');

                //Find node to insert to
                var $upperLabel = $(this).closest('.btn-dropdown').find('.col-left');
                var $ttl = $upperLabel.find('.ttl');
                var $dt = $upperLabel.find('.dt');

                //Find clicked nodes texts
                var thisTtl = $(this).find('.ttl').text();
                var thisDt = $(this).find('.dt').text();

                //Insert text into parent label node
                $ttl.text(thisTtl);
                $dt.text(thisDt);
                if (document.body.clientWidth < 768) {
                    $('#weeks-tab').hide();
                    $('#weeks-tab').addClass('hidden-xs');
                };

                //Add active class to current label week
                $(this).parent().children().each(function() {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');

                var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
            });
            $('#weeks-tab a:first').tab('show');
            $('.week-click').on('click touchstart', function() {
                $('#weeks-tab').removeClass('hidden-xs');
            });
        };
        bootstrapTabs();

        //Toogle event weeks right or left
        var $leftPaging = $('.paging .event-dates.pull-left');
        var $rightPaging = $('.paging .event-dates.pull-right');

        function sideClick(direction, node) {
            if (direction === 'right') {
                if (currentTabNumber < 3) {
                    currentTabNumber++;
                    $(node).closest('.paging').children().each(function() {
                        $(this).removeClass('off');
                    });
                    $('#weeks-tab a:eq(' + currentTabNumber + ')').tab('show');
                    $tabsArray.each(function() {
                        $(this).removeClass('active');
                    });
                    $($tabsArray[currentTabNumber]).addClass('active');
                    var $upperLabel = $tabsArray.closest('.btn-dropdown').find('.col-left');
                    var $ttl = $upperLabel.find('.ttl');
                    var $dt = $upperLabel.find('.dt');

                    //Find clicked nodes texts
                    var thisTtl = $($tabsArray[currentTabNumber]).find('.ttl').text();
                    var thisDt = $($tabsArray[currentTabNumber]).find('.dt').text();

                    //Insert text into parent label node
                    $ttl.text(thisTtl);
                    $dt.text(thisDt);

                    var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
                };
                if (currentTabNumber === 3) {
                    $(node).closest('.event-dates').addClass('off');
                };
            } else {
                if (currentTabNumber > 0) {
                    currentTabNumber--;
                    $(node).closest('.paging').children().each(function() {
                        $(this).removeClass('off');
                    });
                    $('#weeks-tab a:eq(' + currentTabNumber + ')').tab('show');
                    $tabsArray.each(function() {
                        $(this).removeClass('active');
                    });
                    $($tabsArray[currentTabNumber]).addClass('active');
                    var $upperLabel = $tabsArray.closest('.btn-dropdown').find('.col-left');
                    var $ttl = $upperLabel.find('.ttl');
                    var $dt = $upperLabel.find('.dt');

                    //Find clicked nodes texts
                    var thisTtl = $($tabsArray[currentTabNumber]).find('.ttl').text();
                    var thisDt = $($tabsArray[currentTabNumber]).find('.dt').text();

                    //Insert text into parent label node
                    $ttl.text(thisTtl);
                    $dt.text(thisDt);

                    var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
                };
                if (currentTabNumber === 0) {
                    $(node).closest('.event-dates').addClass('off');
                };
            };
        };
        $leftPaging.on('click touchstart', function() {
            sideClick('left', this);
        });
        $rightPaging.on('click touchstart', function() {
            sideClick('right', this);
        });
        $(window).resize(function() {
            var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
        });
    };

    cubeObj.galleryPage = function() {
        var $galleryContainer = $('.gallery-tiles');
        var $galleryText = $('.gall-close');
        var $scrollButton = $('.scroll-down');
        var $borderGallery = $('.border-gall');

        $scrollButton.on('click', function() {
            if ($galleryText.hasClass('active')) {
                $scrollButton.find('.scroll-down-inner').text('about this event');
                $galleryContainer.slideDown(700);
                setTimeout(function() {
                    $galleryText.removeClass('active');
                    // $scrollButton.removeClass('active');
                    // $borderGallery.removeClass('active');
                    $('html,body').scrollTop(0);
                }, 700);
                $scrollButton.removeClass('active top');
                $borderGallery.removeClass('active');
            } else {
                $borderGallery.addClass('active');
                $scrollButton.addClass('active top');
                $scrollButton.find('.scroll-down-inner').text('to gallery');
                $galleryText.addClass('active');
                $galleryContainer.slideUp(700);
                $('html, body').animate({
                    scrollTop: 0
                }, 700);
            };
        });
    };

    // Init
    cubeObj.init = function() {

        //If it's fullscreen slider slider
        if ($('.slider').length) {
            this.slider();
            this.scrollAtOnce();
            this.headerToTop();
            this.fullHeightSLider();
            this.addVideos();
            this.partnersSlider();
        };

        //If it's default slider
        if ($('.slider-default').length) {
            this.defaultSlider();
            this.fullHeightSLider();
            this.headerToTop();
            this.addVideosDefault();
            this.partnersSlider();
            var defaultBlogs = new EventAnimate($('.blog-item-def'));
        };
        this.calendar();
        this.validateEmail();
        this.ticketEventAnimate();
        this.btnToogle();
        this.responsiveImg();
        this.videoImgResponsive();
        this.defaults();
        if ($('section.all-events.events-tiles').length) {
            this.eventsTile();
        };
        if ($('section.events-list').length) {
            this.eventsTile();
        };
        if ($('.absi').length) {
            this.eventView();
        };
        if ($('.gallery-tiles').length) {
            this.galleryPage();
        };
    };

    cubeObj.init();
    window.cubeObj = cubeObj;
});