"use strict";
appMakeBeCool.gateway.addClass('MasonryTiles', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _masontyTiles = this,
        _defaults = {
            masnBoxGalr: $('#masnrGallery'),
            masnBox: $('#masnBox'),
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            masnBoxGalr: null,
            masnBox: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_masontyTiles, [_properties]);
            if (!_globals.preloaded) {
                return _masontyTiles.init();
            }
            _masontyTiles.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _masontyTiles.create();
        },

        _config = function () {
            _globals.masnBoxGalr = $(_properties.masnBoxGalr);
            _globals.masnBox = $(_properties.masnBox);
        },

        _setup = function () {
            _globals.masnBoxGalr.masonry();
            _globals.masnBox.masonry();

            _masonryBlocks();
            _masonryBlockGal();
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {};
        },

        _triggers = function () {
            return {};
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

        _setCustomMethods = function () {
            _masontyTiles.globals.customResurrect = function () {
            };
            _masontyTiles.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _masontyTiles.addMethod('init', function () {
        _masontyTiles.bind($window, _masontyTiles.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});