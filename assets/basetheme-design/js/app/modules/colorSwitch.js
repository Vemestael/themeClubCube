"use strict";
appMakeBeCool.gateway.addClass('ColorSwitch', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _colorSwitch = this,
        _defaults = {
            // elements
            clrPicker: '.clr-picker',
            linkItm: '[href^="css/skins/"]'
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            clrPicker: null,
            linkItm: null,

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
        },

        _setup = function () {
        },

        _setBinds = function () {
            _binds().setChangeClr();
        },

        _binds = function () {
            return {
                setChangeClr: function () {
                    _globals.clrPicker.on('click', function () {
                        if ($(this).hasClass('green')) {
                            _globals.linkItm.attr('href', 'css/skins/green-violet.css');
                            console.log(12)
                        }
                        if ($(this).hasClass('orange')) {
                            _globals.linkItm.attr('href', 'css/skins/orange-red.css');
                            console.log(21)
                        }
                    });
                }
            }
        },

        _triggers = function () {
            return {}
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