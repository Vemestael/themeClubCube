"use strict";
appMakeBeCool.gateway.addClass('Custom', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _custom = this,
        _defaults = {
            masnBox: $('#masnBox'),
            masnBoxGalr: $('#masnrGallery'),
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
        },

        _setup = function () {
            _globals.masnBox.masonry();
            _globals.masnBoxGalr.masonry();

            _masonryBlocks();
            _masonryBlockGal();
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {
            };
        },

        _triggers = function () {
            return {
            };
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
                    duration: 500
                }
            });
        },

        _masonryBlockGal = function () {
            _globals.masnBoxGalr.masonry({
                itemSelector: '.c-box',
                singleMode: true,
                isResizable: false,
                //gutter: 10,
                columnWidth: '.grid-sizer',
                percentPosition: false,
                isAnimated: true,
                animationOptions: {
                    queue: false,
                    duration: 500,
                    easing: 'linear',
                }
            });
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