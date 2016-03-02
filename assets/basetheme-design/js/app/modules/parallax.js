"use strict";
appMakeBeCool.gateway.addClass('Parallax', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _parallax = this,
        _defaults = {
            prlxBack: '#parallaxBack',
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            prlxBack: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_parallax, [_properties]);
            if (!_globals.preloaded) {
                return _parallax.init();
            }
            _parallax.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _parallax.create();
        },

        _config = function () {
            _globals.prlxBack = $(_properties.prlxBack);
        },

        _setup = function () {
            _parallaxStart();
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {};
        },

        _triggers = function () {
            return {};
        },

        _parallaxStart = function () {
            if ($window.width() > 992) {
                $.stellar({
                    horizontalScrolling: false,
                    verticalOffset: 100
                })
            }
        },

        _setCustomMethods = function () {
            _parallax.globals.customResurrect = function () {
            };
            _parallax.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _parallax.addMethod('init', function () {
        _parallax.bind($window, _parallax.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});