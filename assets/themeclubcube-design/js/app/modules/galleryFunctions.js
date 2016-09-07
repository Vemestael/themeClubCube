"use strict";
appMakeBeCool.gateway.addClass('GalleryFunctions', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _gallery = this,
        _defaults = {
            GlrMagic: '#GlrMagic',
            scrlBtnGlr: '#scrlBtnGlr',
            glrContent: '.b-gallery__content',
            glrTiles: '.b-gallery__tiles',
            header: '#header',
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {

            GlrMagic: null,
            scrlBtnGlr: null,
            glrContent: null,
            glrTiles: null,
            header: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_gallery, [_properties]);
            if (!_globals.preloaded) {
                return _gallery.init();
            }
            _gallery.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _gallery.create();
        },

        _config = function () {

            _globals.GlrMagic = $(_properties.GlrMagic);
            _globals.scrlBtnGlr = $(_properties.scrlBtnGlr);
            _globals.glrContent = $(_properties.glrContent);
            _globals.glrTiles = $(_properties.glrTiles);
            _globals.header = $(_properties.header);
        },

        _setup = function () {
            // Bg color for b-container in button page
            $('.b-tabs__nav-btn li').on('click', function () {
                if($(this).hasClass('dark__bg')) {
                    $('#bgClr').addClass('dark-bg');
                    $('.b-tabs__nav li').css({
                        boxShadow: '0 0 0 2px #FFFFFF inset'
                    })
                }
                else {
                    $('#bgClr').removeClass('dark-bg');
                    $('.b-tabs__nav li').css({
                        boxShadow: '0 0 0 2px #202020 inset'
                    })
                }
            });

            _popupGlr();
            _fullScreenGlr();
        },

        _setBinds = function () {
            _binds().setScrollOnBtn();
        },

        _binds = function () {
            return {
                setScrollOnBtn: function () {
                    _gallery.bind(_globals.scrlBtnGlr, 'click', function () {

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
            };
        },

        _triggers = function () {
            return {};
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
                }
            });
        },

        _fullScreenGlr = function () {
            if (_globals.glrTiles.height() < $window.height()) {
                _globals.glrTiles.height(
                    $window.height()
                )
            }
            else {
                return false
            }
        },


        _setCustomMethods = function () {
            _gallery.globals.customResurrect = function () {
            };
            _gallery.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _gallery.addMethod('init', function () {
        _gallery.bind($window, _gallery.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});