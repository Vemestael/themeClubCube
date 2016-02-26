"use strict";
appMakeBeCool.gateway.addClass('Custom', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _custom = this,
        _defaults = {
            masnBox: $('#masnBox'),
            masnBoxGalr: $('#masnrGallery'),
            header: '#header',
            prlxBack: '#parallaxBack',
            GlrMagic: '#GlrMagic',
            scrlBtnGlr: '#scrlBtnGlr',
            glrContent: '.b-gallery__content',
            glrTiles: '.b-gallery__tiles'
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            masnBox: null,
            masnBoxGalr: null,
            addMoreBlogs: null,
            header: null,
            prlxBack: null,
            GlrMagic: null,
            scrlBtnGlr: null,
            glrContent: null,
            glrTiles: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_custom, [_properties]);
            if (!_globals.preloaded) {
                return _custom.init();
            }
            _custom.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _custom.create();
        },

        _config = function () {
            _globals.masnBox = $(_properties.masnBox);
            _globals.masnBoxGalr = $(_properties.masnBoxGalr);
            _globals.header = $(_properties.header);
            _globals.prlxBack = $(_properties.prlxBack);
            _globals.GlrMagic = $(_properties.GlrMagic);
            _globals.scrlBtnGlr = $(_properties.scrlBtnGlr);
            _globals.glrContent = $(_properties.glrContent);
            _globals.glrTiles = $(_properties.glrTiles);
        },

        _setup = function () {
            _globals.masnBox.masonry();
            _globals.masnBoxGalr.masonry();

            _masonryBlocks();
            _masonryBlockGal();
            _parallaxStart();
            _popupGlr();
            _ResizeImgGlr();
        },

        _setBinds = function () {
            _binds().setScrollHeader();
            _binds().setScrollOnBtn();
            _binds().setResizeImgGlr();
        },

        _binds = function () {
            return {
                setScrollHeader: function () {
                    _custom.bind($window, 'scroll', function () {
                        _stickyHeader();
                    });
                }
                , setScrollOnBtn: function () {
                    _custom.bind(_globals.scrlBtnGlr, 'click', function () {

                        if (_globals.glrContent.hasClass('active')) {
                            _globals.scrlBtnGlr.find('.btn-pointer-b > b').text('about this event');
                            _globals.glrTiles.animate({
                                opacity: 1
                            }, {
                                step: function (now, fx) {
                                    $(this).css({
                                        'transform': 'translate3d(0px, 0px, 0px)',
                                        'transition': 'transform 0.7s ease-in',
                                    })
                                },
                                easening: 'linear',
                                duration: 700
                            });
                            setTimeout(function () {
                                $('html,body').scrollTop(0);
                            }, 700);
                            $('.b-gallery__border').removeClass('active');
                            $('.b-scroll').removeClass('active')
                            $('.b-gallery__content').removeClass('active');
                            _globals.glrTiles.removeClass('top');
                        }
                        else {
                            $('.b-gallery__border').addClass('active');
                            $('.b-scroll').addClass('active');
                            $('.b-gallery__content').addClass('active');
                            _globals.glrTiles.addClass('top');
                            _globals.scrlBtnGlr.find('.btn-pointer-b > b').text('go to gallery');
                            _globals.glrTiles.animate({
                                opacity: 1
                            }, {
                                step: function (now, fx) {
                                    $(this).css({
                                        'transform': 'translate3d(0px,' + (-_globals.glrTiles.height() - _globals.header.height()) + 'px, 0px)',
                                        'transition': 'transform 0.8s ease-in',
                                    })
                                },
                            });
                            setTimeout(function () {
                                $('html, body').animate({
                                    scrollTop: 0
                                }, {
                                    easening: 'linear',
                                    duration: 700
                                });
                                return false
                            }, 600);
                        }
                    });
                }
                , setResizeImgGlr: function () {
                    _custom.bind($window, 'resize', function () {
                        var $blImg = $('.b-gallery__popup a');
                        if ($window.width() > 1280) {
                            $blImg.height(
                                $blImg.width() / 1.33
                            )
                        }
                    });
                }
            };
        },

        _triggers = function () {
            return {};
        },

        _stickyHeader = function () {
            var offsetop = $window.scrollTop();
            if (offsetop > _globals.header.height()) {
                _globals.header.addClass('header__sticky');
            } else (_globals.header.removeClass('header__sticky'))
        },

        _masonryBlocks = function () {
            _globals.masnBox.masonry({
                itemSelector: '.b-box',
                singleMode: true,
                isResizable: true,
                gutter: 30,
                percentPosition: true,
                columnWidth: '.b-box',
                isAnimated: true,
                animationOptions: {
                    queue: false,
                    duration: 400
                }
            });
        },

        _masonryBlockGal = function () {
            setTimeout(function () {
                _globals.masnBoxGalr.masonry({
                    itemSelector: '.c-box',
                    singleMode: true,
                    isResizable: false,
                    //gutter: 10,
                    columnWidth: '.grid-sizer',
                    percentPosition: false,
                    resize: false,
                    isAnimated: true,
                    animationOptions: {
                        queue: false,
                        duration: 400,
                        easing: 'ease',
                    }
                })
            });
        },

        _parallaxStart = function () {
            if ($window.width() > 992) {
                $.stellar({
                    horizontalScrolling: false,
                    verticalOffset: 100
                })
            }
        },

        _popupGlr = function () {
            _globals.GlrMagic.magnificPopup({
                removalDelay: 100,
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading img ...',
                mainClass: 'mfp-fade',
                fixedContentPos: true,
                preloader: true,
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [1, 4] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    //titleSrc: function(item) {
                    //  return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                    //}
                },
            });
        },

        _ResizeImgGlr = function () {
            var $blImg = $('.b-gallery__popup a');

            if ($window.width() > 1280) {
                setTimeout(function () {
                    $blImg.height(
                        $blImg.width() / 1.33
                    )
                }, 50)
            }
        },

        _setCustomMethods = function () {
            _custom.globals.customResurrect = function () {
            };
            _custom.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _custom.addMethod('init', function () {
        _custom.bind($window, _custom.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});