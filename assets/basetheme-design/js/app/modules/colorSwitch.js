"use strict";
appMakeBeCool.gateway.addClass('ColorSwitch', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _colorSwitch = this,
        _defaults = {
            // elements
            clrPicker: '.clr-picker',
            linkItm: '[href^="css/skins/"]',
            wideScrn: '.navbar__tint-wide'

        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            clrPicker: null,
            linkItm: null,
            wideScrn: null,

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_colorSwitch, [_properties]);
            if (!_globals.preloaded) {
                return _colorSwitch.init();
            }
            _colorSwitch.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _colorSwitch.create();
        },

        _config = function () {
            _globals.clrPicker = $(_properties.clrPicker);
            _globals.linkItm = $(_properties.linkItm);
            _globals.wideScrn = $(_properties.wideScrn);
        },

        _setup = function () {
            _changeClr();
            _changeWide();
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {
            }
        },

        _triggers = function () {
            return {}
        },

        _changeClr = function () {
            _globals.clrPicker.on('click', function () {
                if ($(this).hasClass('green')) {
                    _globals.linkItm.attr('href', 'css/skins/green-violet.css');
                }
                if ($(this).hasClass('orange')) {
                    _globals.linkItm.attr('href', 'css/skins/orange-red.css');
                }
                if ($(this).hasClass('crimson')) {
                    _globals.linkItm.attr('href', 'css/skins/crimson-cyan.css');
                }
                if ($(this).hasClass('yellow')) {
                    _globals.linkItm.attr('href', 'css/skins/yellow-pink.css');
                }
                if ($(this).hasClass('brown')) {
                    _globals.linkItm.attr('href', 'css/skins/brown-gray.css');
                }
                _globals.clrPicker.removeClass('active');
                $(this).addClass('active');
            });
        },

        _changeWide = function () {
            _globals.wideScrn.on('click', function () {
                _globals.wideScrn.removeClass('active');
                $(this).addClass('active');
            })
        },

        _toggleMenuCheckup = function () {

        },

        _setCustomMethods = function () {
            _colorSwitch.globals.customResurrect = function () {
            };
            _colorSwitch.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _colorSwitch.addMethod('init', function () {
        _colorSwitch.bind($window, _colorSwitch.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});