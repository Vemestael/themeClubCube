$(function() {
    'use strict';
    var cubeObj = {};

    cubeObj.fullHeightSlides = function() {
        function fullHeight() {
            var $slider = $('#slider');
            var $slides = $slider.find('.s-panel');
            var windowHeight = window.innerHeight;
            var windowWidth = window.innerWidth;

            $slides.each(function() {
                var _img = $(this).find('.bg-tile').first().find('img');
                var _imgHeight = $(_img).height();
                var _imgWidth = $(_img).width();
                if (windowWidth > windowHeight) {
                    $(this).width(windowWidth);
                    $(this).height(_imgHeight);
                    $(this).css('top', -((_imgHeight - windowHeight) / 2));
                    $(this).css('left', 0);
                } else {
                    $(this).css('left', -((_imgWidth - windowWidth) / 2));
                    $(this).css('top', 0);
                    $(this).width(_imgWidth);
                };
            });
        };
        $(window).resize(function() {
            fullHeight();
        });
        fullHeight();
    };

    // Fullscreen Slider
    cubeObj.slider = function() {
        var $sliderNode = $('.slider');
        var $topEventsSLider = $('.top-events-sliders');
        // window.tileSlide = new TileSlide(document.querySelector('.slider'), {
        //     dots: false,
        //     interval: 5000
        // });
        if (window.innerWidth > 479) {
            $topEventsSLider.slick({
                slidesToShow: 3,
                easing: 'easeInExpo',
                draggable: false,
                speed: 900,
                swipe: true,
                dots: false,
                infinite: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        dots: false
                    }
                }, {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: false,
                        dots: true
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: false,
                        arrows: false,
                        dots: true
                    }
                }]
            });
        };

        // this.fullHeightSlides();
    };

    //Defaul slider page
    cubeObj.defaultSlider = function() {
        // var $sliderNode = $('.slider');
        // var $topEventsSLider = $('.top-events-sliders');
        // window.tileSlide = new TileSlide(document.querySelector('.slider-default'), {
        //     dots: true
        // });
        // this.fullHeightSlides();
    };

    cubeObj.partnersSlider = function() {
        //Slider for partners
        function partnerSlider() {
            // if (window.innerWidth < 768) {
            $('.partners-slider').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                touchMove: false,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        dots: true
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        dots: false,
                        infinite: false,
                        speed: 400,
                        slidesToShow: 1,
                        touchMove: false,
                        slidesToScroll: 1,
                    }
                }]
            });
        };
        $(window).resize(function() {
            partnerSlider();
        });
        partnerSlider();
    };

    cubeObj.menuPreventClick = function() {
        var $menuLink = $('.dropdown-toggle');

        $menuLink.click(function() {

        });
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
        // runResize();
        // $(window).resize(function() {
        //     runResize();
        // });
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
            // $('.slider').slickPause();
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
                // tileSlide.stopSlide();

            } else if (($(window).scrollTop() <= $slider.outerHeight()) && (_scrollValue < scrollTopValue) && (scrollToogle === true)) {
                scrollToogle = false;
                setDefaultPositions();
                $('header').removeClass('header-top active');
                // Autoplay slider
                // $('.slider').slickPlay();
                // tileSlide.playSlide();
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
                // tileSlide.stopSlide();
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
                // tileSlide.playSlide();
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

            if ($('.slider').length || $('.slider-default').length) {
                if (($(window).scrollTop() > $('.slider').height()) && (!$header.hasClass('header-top'))) {
                    $header.addClass('header-top active');
                    setTimeout(function() {
                        $header.removeClass('active');
                    }, 2000);
                    ;
                    console.log('Init Slider page added header-top class');
                    $('body').css('position','inherit');
                } else {
                    console.log('Init Slider page header-top class is exists');
                };
            } else {
                if (!$header.hasClass('header-top')) {
                    $header.addClass('header-top active');
                    setTimeout(function() {
                        $header.removeClass('active');
                    }, 2000);
                    console.log('Init nonSlider page added header-top class');
                } else {
                    console.log('Init nonSlider page header-top class exists');
                };
            };

            $(document).scroll(function() {
                if ($('.slider').length || $('.slider-default').length) {
                    if (($(window).scrollTop() > $('.slider').height()) && (!$header.hasClass('header-top'))) {
                        $header.addClass('header-top active');
                        setTimeout(function() {
                            $header.removeClass('active');
                        }, 2000);
                        $('body').css('position','inherit');
                        console.log('Slider page added header-top class');
                    } else if (($(window).scrollTop() <= $header.height()) && ($header.hasClass('header-top')) && (!$('.navbar-collapse').hasClass('in'))) {
                        $header.removeClass('header-top active');
                        console.log('Slider page removed header-top class');
                        $('body').css('position','relative');
                    };
                } else {
                    if (!$header.hasClass('header-top')) {
                        $header.addClass('header-top active');
                        setTimeout(function() {
                            $header.removeClass('active');
                        }, 2000);
                        console.log('Non slider page added header-top class');
                    } else {
                        console.log('Non slider page header-top class exists');
                    };
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
            var sliderTopPadding = (windowHeight - slideNodeHeight) / 2;

            // $slideClick.css('top', slideClickTop);
            // $slideClickNext.css('top', slideClickTop);
            if ((windowWidth > 479) && (windowHeight < 400) && ($('.slider').length)) {
                $rows.css('top', 55);
            } else if ((slideNodeHeight < windowHeight) && ($('.slider').length)) {
                $rows.css('top', sliderTopPadding + 10);
            } else if ((slideNodeHeight < windowHeight) && ($('.slider-default').length)) {
                // $rows.css('top', sliderTopPadding + 10);
                 $rows.css('top', (sliderHeight - slideNodeHeight)/2 - 20);
                console.log('Default slider <', sliderHeight, slideNodeHeight);
            } else {
                $rows.css('top', '110px');
            };
            // if ((slideNodeHeight < windowHeight) && (window.devicePixelRatio === 2) && ((windowWidth) === 1024)) {
            //     $rows.css('top', (((windowHeight / 2) - slideNodeHeight)) + 40);
            // };
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
        $EmailFooterForm.submit(function(event) {
            if (regEmail.test($emailInput.val()) === true) {
                $('#email-subscribe').tooltip('destroy');
                $('#email-subscribe').tooltip({
                    container: 'body',
                    placement: 'top',
                    title: 'No Email',
                    trigger: 'manual'
                }).tooltip('show');

            } else if ($('#email-subscribe').val().length === 0) {
                $('#email-subscribe').tooltip('destroy');
                $('#email-subscribe').tooltip({
                    container: 'body',
                    placement: 'top',
                    title: 'No Email',
                    trigger: 'manual'
                }).tooltip('show');
                event.preventDefault();
            } else if (regEmail.test($emailInput.val()) === false) {
                $('#email-subscribe').tooltip('destroy');
                $('#email-subscribe').tooltip({
                    container: 'body',
                    placement: 'top',
                    title: 'Please, enter valid Email',
                    trigger: 'manual'
                }).tooltip('show');
                event.preventDefault();
            };
        });
    };

    //Fullscreen Iframe sizing
    cubeObj.addVideos = function() {
        var $iframes = $('.video-bg');
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;

        //if width is bigger than height
        if (windowWidth > windowHeight) {
            // $iframes.width(windowWidth);
            // $iframes.height(windowWidth / 1.777);
            var videoWidth = windowHeight * 1.77669;
            var videoHeight = windowWidth / 1.77669;
            if (videoWidth > windowWidth) {
                videoWidth += 200;
                $iframes.width(videoWidth);
                $iframes.height(videoWidth / 1.77669);
                $iframes.css('left', -((videoWidth - windowWidth) / 2));
                $iframes.css('top', 0);
                // console.log('videoWidth > windowWidth');
            } else if (videoHeight > windowHeight) {
                videoHeight += 40;
                $iframes.height(videoHeight);
                $iframes.width(videoHeight * 1.77669);
                $iframes.css('top', -((videoHeight - windowHeight - 35) / 2));
                $iframes.css('left', -(((videoHeight * 1.77669) - windowWidth) / 2));
                // console.log('videoHeight > windowHeight');
            };
        } else if (windowWidth < windowHeight) {

            $iframes.height(windowHeight + 200);
            $iframes.width(windowWidth);
            $iframes.css('top', -100);
            $iframes.css('left', 0);
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

        $(window).resize(function() {
            cubeObj.addVideosDefault();
        });
    };

    //Button hider
    cubeObj.btnToogle = function() {
        var $btnHider = $('.button-dropdown');
        $btnHider.on('touchstart touchend click', function(event) {
            event.preventDefault();
            // console.log('clicked');
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
            if (window.innerWidth > 990) {
                event.preventDefault();
            };
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

        var $sliderNode = $('.slider');
        var $topEventsSLider = $('.top-events-sliders');
        window.tileSlide = new TileSlide(document.querySelector('.slider-default'), {
            dots: true,
            interval: 8000
        });

        this.fullHeightSlides();

        $('.default-slider-tickets').slick({
            slidesToShow: 1,
            dots: false,
            easing: 'easeInExpo',
            autoplay: false,
            autoplaySpeed: 4200,
            draggable: false,
            infinite: false,
            speed: 300,
            vertical: true
        });
        if (window.innerWidth > 479) {
            $('.default-gallery-slider').slick({
                slidesToShow: 3,
                arrows: true,
                easing: 'easeInExpo',
                draggable: false,
                speed: 900,
                swipe: true,
                dots: false,
                infinite: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        arrows: true,
                        dots: false
                    }
                }, {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: false,
                        arrows: true,
                        dots: false
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: false,
                        arrows: true,
                        dots: false
                    }
                }]
            });
        };
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
        var $leftPaging = $('.left-pag');
        var $rightPaging = $('.right-pag');
        var $tabPanels = $('.tab-pane');

        function bootstrapTabs() {
            function findPressedTabNumber(pressedTab) {
                for (var i = 0; i < 4; i++) {
                    if (pressedTab === $tabsArray[i]) {
                        currentTabNumber = i;
                    };
                };
            };
            $('#weeks-tab a').on('click touchend', function(event) {
                event.preventDefault();
                findPressedTabNumber(this);
                // console.log(currentTabNumber);
                if (currentTabNumber === 0) {
                    $leftPaging.addClass('off');
                    $rightPaging.removeClass('off');
                } else if (currentTabNumber === ($tabPanels.length - 1)) {
                    $rightPaging.addClass('off');
                    $leftPaging.removeClass('off');
                } else {
                    $leftPaging.removeClass('off');
                    $rightPaging.removeClass('off');
                };
                $(this).tab('show');

                //Find node to insert to
                var $upperLabel = $(this).closest('.button-dropdown').find('.button-dropdown-text');
                var $ttl = $upperLabel.find('.dropdown-text-title');
                var $dt = $upperLabel.find('.dropdown-text-dates');

                //Find clicked nodes texts
                var thisTtl = $(this).find('.dropdown-text-title').text();
                var thisDt = $(this).find('.dropdown-text-dates').text();

                //Insert text into parent label node
                $ttl.text(thisTtl);
                $dt.text(thisDt);
                if (document.body.clientWidth < 768) {
                    $('#weeks-tab').hide();
                    $('#weeks-tab').addClass('hidden-xs');
                };

                //Add active class to current label week
                $(this).parent().children().each(function() {
                    $(this).removeClass('active pressed');
                });
                $(this).addClass('active pressed');

                var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
            });
            $('#weeks-tab a:first').tab('show');
            $('.week-click').on('click touchend', function() {
                $('#weeks-tab').removeClass('hidden-xs');
            });
        };
        bootstrapTabs();

        function sideClick(direction, node) {
            if (direction === 'right') {
                if (currentTabNumber < 3) {
                    currentTabNumber++;
                    $(node).closest('.paging').children().each(function() {
                        $(this).removeClass('off');
                    });
                    $('#weeks-tab a:eq(' + currentTabNumber + ')').tab('show');
                    $tabsArray.each(function() {
                        $(this).removeClass('active pressed');
                    });
                    $($tabsArray[currentTabNumber]).addClass('active pressed');
                    var $upperLabel = $tabsArray.closest('.button-dropdown').find('.button-dropdown-text');
                    var $ttl = $upperLabel.find('.dropdown-text-title');
                    var $dt = $upperLabel.find('.dropdown-text-dates');
                    var $rightTtl = $('.right-pag').find('.pad-title');
                    var $rightDt = $('.right-pag').find('.pad-dates');
                    var $leftTtl = $('.left-pag').find('.pad-title');
                    var $leftDt = $('.left-pag').find('.pad-dates');

                    //Find clicked nodes texts
                    var thisTtl = $($tabsArray[currentTabNumber]).find('.dropdown-text-title').text();
                    var thisDt = $($tabsArray[currentTabNumber]).find('.dropdown-text-dates').text();
                    var previousTtl = $($tabsArray[currentTabNumber - 1]).find('.dropdown-text-title').text();
                    var previousDt = $($tabsArray[currentTabNumber - 1]).find('.dropdown-text-dates').text();

                    //Insert text into parent label node
                    $ttl.text(thisTtl);
                    $dt.text(thisDt);
                    $rightTtl.text(thisTtl);
                    $rightDt.text(thisDt);
                    $leftTtl.text(previousTtl);
                    $leftDt.text(previousDt);

                    $('html, body').animate({
                        scrollTop: 0
                    }, 300);
                    setTimeout(function() {
                        var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
                    }, 300);
                };
                if (currentTabNumber === ($tabPanels.length - 1)) {
                    // $(node).closest('.event-dates').addClass('off');
                    $(node).addClass('off');
                };
            } else {
                if (currentTabNumber > 0) {
                    currentTabNumber--;
                    $(node).closest('.paging').children().each(function() {
                        $(this).removeClass('off');
                    });
                    $('#weeks-tab a:eq(' + currentTabNumber + ')').tab('show');
                    $tabsArray.each(function() {
                        $(this).removeClass('active pressed');
                    });
                    $($tabsArray[currentTabNumber]).addClass('active pressed');
                    var $upperLabel = $tabsArray.closest('.button-dropdown').find('.button-dropdown-text');
                    var $ttl = $upperLabel.find('.dropdown-text-title');
                    var $dt = $upperLabel.find('.dropdown-text-dates');
                    var $leftTtl = $('.left-pag').find('.pad-title');
                    var $leftDt = $('.left-pag').find('.pad-dates');
                    var $rightTtl = $('.right-pag').find('.pad-title');
                    var $rightDt = $('.right-pag').find('.pad-dates');

                    //Find clicked nodes texts
                    var thisTtl = $($tabsArray[currentTabNumber]).find('.dropdown-text-title').text();
                    var thisDt = $($tabsArray[currentTabNumber]).find('.dropdown-text-dates').text();
                    var nextTtl = $($tabsArray[currentTabNumber + 1]).find('.dropdown-text-title').text();
                    var nextDt = $($tabsArray[currentTabNumber + 1]).find('.dropdown-text-dates').text();

                    //Insert text into parent label node
                    $ttl.text(thisTtl);
                    $dt.text(thisDt);
                    $leftTtl.text(thisTtl);
                    $leftDt.text(thisDt);
                    $rightTtl.text(nextTtl);
                    $rightDt.text(nextDt);

                    $('html, body').animate({
                        scrollTop: 0
                    }, 300);
                    setTimeout(function() {
                        var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
                    }, 300);
                };
                if (currentTabNumber === 0) {
                    // $(node).closest('.event-dates').addClass('off');
                    $(node).addClass('off');
                };
            };
        };
        $leftPaging.on('click touchend', function() {
            sideClick('left', this);
        });
        $rightPaging.on('click touchend', function() {
            sideClick('right', this);
        });
        $(window).resize(function() {
            var topEventCon = new EventAnimate($('.tab-pane.active .top-event'));
        });
    };


    //***************Gallery page*****************//
    cubeObj.galleryPage = function() {
        var $galleryContainer = $('.gallery-tiles');
        var $galleryText = $('.gall-close');
        var $scrollButton = $('.scroll-down');
        var $borderGallery = $('.border-gall');
        var $galleryCount = $('.gall-count');
        var $imagesCounter = $('.img-counter');
        var $allImagesBlock = $('.all-btn');
        var $galleryHeader = $('.gallery-tiles h1');
        var $curentImageContainer = '';
        var $allImgContainers = $('.gallery-tile');
        var $videoIframes = $('.content-video.hiddens');

        var events = new EventAnimate($('.top-event'));
        var blogs = new EventAnimate($('.blog-item-def'));

        $('.tooltips-show').tooltip();
        tinyAnimations.buttonSlider($('.button-slider'));
        tinyAnimations.buttonArrow($('.button-arrow-left'));
        tinyAnimations.radioButton($('.rb-lb'));
        tinyAnimations.checkboxButton($('.chb-lb'));

        //Cunts all videos and images from gallery
        function countImgAndVideos() {

        };

        //Counts current image on init of gallery
        function countImages() {
            // console.log('Init images count');
            var $galleryTiles = $('.gallery-tile');
            var imagesLength = $galleryTiles.length;
            var $currentImg = $('#imagelightbox');
            var currentImageNumber = 1;
            for (var i = 0; i < imagesLength; i++) {
                if ($galleryTiles[i].href === $curentImageContainer[0].href) {
                    currentImageNumber = i + 1;
                };
            };
            $imagesCounter.text(currentImageNumber + '/' + imagesLength);
        };

        //Count images and videos on every navigation click
        function imgCounter() {
            var $openedImage = $('#imagelightbox');
            var $galleryTiles = $('.gallery-tile');
            var $target = $('.gallery-tile' + '[href="' + $openedImage.attr('src') + '"]');
            var index = $target.index('.gallery-tile');
            // console.log(index);
            $imagesCounter.text((index + 1) + '/' + $galleryTiles.length);
        };

        //Click navigation of gallery
        function clickGalleryNavigation(direction) {
            var $openedImage = $('#imagelightbox');
            var $galleryTiles = $('.gallery-tile');
            var $target = $('.gallery-tile' + '[href="' + $openedImage.attr('src') + '"]');
            var index = $target.index('.gallery-tile');
            if (direction === 'left') {
                index = index - 1;
                if (!$galleryTiles.eq(index).length) {
                    index = $galleryTiles.length;
                };
            } else {
                index = index + 1;
                if (!$galleryTiles.eq(index).length) {
                    index = 0;
                };
            };
            $galleryLightBox.switchImageLightbox(index);
            return false;
        };

        //Init the nodes and gallery
        function showGalleryPicture() {
            var $images = $('.gallery-tile');
            $allImgContainers = $('.gallery-tile');
            if (!$('.imageLightboxWrap').length) {
                var wrapper = '<div class="imageLightboxWrap"></div>';
                // var loader = '<img class="loader-gif" src="images/ajax-loader.gif" alt="">';
                var loader = '<div class="loader-gall"><div class="fr-bl"></div><div class="sc-bl"></div><div class="thr-bl"></div><div class="fth-bl"></div></div>';
                var prevNavigation = '<div class="lightbox-prev"></div>';
                var nextNavigation = '<div class="lightbox-next"></div>';
                $(wrapper).appendTo('body');
                $(loader).appendTo('body');
                $(prevNavigation).appendTo('body');
                $(nextNavigation).appendTo('body');

                $('.lightbox-prev').on('click touchend', function() {
                    clickGalleryNavigation('left');
                });
                $('.lightbox-next').on('click touchend', function() {
                    clickGalleryNavigation('right');
                });
            } else {
                $('.imageLightboxWrap').fadeIn();
                $('.lightbox-prev').show();
                $('.lightbox-next').show();
                $('.loader-gall').show();
            };
            $scrollButton.hide();
            $galleryCount.hide();
            $allImagesBlock.show();
            countImages();
        };

        //Hide all nodea on gallery exit
        function exitGalleryPicture() {
            var $images = $('.gallery-tile');
            var $wrapper = $('.imageLightboxWrap');
            var $prevNavigation = $('.lightbox-prev');
            var $nextNavigation = $('.lightbox-next');
            var $loader = $('.loader-gall');
            $loader.hide();
            $wrapper.fadeOut();
            $prevNavigation.hide();
            $nextNavigation.hide();
            $allImagesBlock.hide();
            $scrollButton.show();
            $galleryCount.show();
        };

        //Gallery loader picture
        function galleryLoader(flag) {
            var $loader = $('.loader-gif');
            if (flag === true) {
                $loader.show();
            } else {
                $loader.hide();
            };
        };

        //Init the gallery
        var $galleryLightBox = $('.gallery-tile').imageLightbox({
            selector: 'id="imagelightbox"', // string;
            allowedTypes: 'png|jpg|jpeg|gif', // string;
            animationSpeed: 250, // integer;
            preloadNext: true, // bool;            silently preload the next image
            enableKeyboard: true, // bool;            enable keyboard shortcuts (arrows Left/Right and Esc)
            quitOnEnd: false, // bool;            quit after viewing the last image
            quitOnImgClick: false, // bool;            quit when the viewed image is clicked
            quitOnDocClick: true, // bool;            quit when anything but the viewed image is clicked
            onStart: function() {
                showGalleryPicture();
            }, // function/bool;   calls function when the lightbox starts
            onEnd: function() {
                exitGalleryPicture();
            }, // function/bool;   calls function when the lightbox quits
            onLoadStart: function() {
                galleryLoader(true);

            }, // function/bool;   calls function when the image load begins
            onLoadEnd: function() {
                galleryLoader(false);
                imgCounter();
            } // function/bool;   calls function when the image finishes loading
        });

        //Toogle modes on gallery page
        $scrollButton.on('click touchend', function() {
            if ($galleryText.hasClass('active')) {
                $scrollButton.find('.scroll-down-inner').text('about this event');
                setTimeout(function() {
                    $videoIframes.removeClass('active');
                }, 300);
                $galleryContainer.animate({
                    top: 0
                }, 700);
                setTimeout(function() {
                    $galleryContainer.removeClass('top');
                    $galleryText.removeClass('active');
                    $('html,body').scrollTop(0);
                }, 700);
                $scrollButton.removeClass('active top');
                $borderGallery.removeClass('active');
            } else {
                $borderGallery.addClass('active');
                setTimeout(function() {
                    $videoIframes.addClass('active');
                }, 300);
                $scrollButton.addClass('active top');
                $scrollButton.find('.scroll-down-inner').text('to gallery');
                $galleryContainer.addClass('top');
                $galleryContainer.animate({
                    top: -($galleryContainer.outerHeight())
                }, 700);
                $galleryText.addClass('active');
                $('html, body').animate({
                    scrollTop: 0
                }, 700);
            };
        });

        $allImagesBlock.on('click', function() {
            $galleryLightBox.quitImageLightbox();
        });

        $allImgContainers.on('click', function() {
            $curentImageContainer = $(this);
        });
    };


    // Init
    cubeObj.init = function() {

        this.menuPreventClick();

        //If it's fullscreen slider slider
        if ($('.slider').length) {
            this.slider();
            this.scrollAtOnce();
            this.headerToTop();
            this.fullHeightSLider();
            // this.addVideos();
            this.partnersSlider();
        };

        //If it's default slider
        if ($('.slider-default').length) {
            this.defaultSlider();
            this.defaults();
            this.fullHeightSLider();
            this.headerToTop();
            // this.addVideosDefault();
            this.partnersSlider();
            var defaultBlogs = new EventAnimate($('.blog-item-def'));
        };
        this.calendar();
        this.validateEmail();
        this.ticketEventAnimate();
        this.btnToogle();
        this.responsiveImg();
        this.videoImgResponsive();
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