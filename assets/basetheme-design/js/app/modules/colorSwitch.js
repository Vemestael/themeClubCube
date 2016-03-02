"use strict";
appMakeBeCool.gateway.addClass('ColorSwitch', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _colorSwitch = this,
        _defaults = {
            // elements
            colorItm: '.color-picker-item',
            linkItm: '[href^="css/not-min/skins/"]'
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            colorItm: null,
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
            }
            _colorSwitch.create();
        },

        _config = function () {
            _globals.colorItm = $(_properties.colorItm);
            _globals.linkItm = $(_properties.linkItm);
        },

        _setup = function () {
            
            _globals.colorItm.on('click', function (){
                if($(this).hasClass('orange')) {
                    _globals.linkItm.attr('href', 'css/not-min/skins/orange.css');
                }

                if($(this).hasClass('blue')) {
                    _globals.linkItm.attr('href', 'css/not-min/skins/blue.css');
                }

                if($(this).hasClass('green')) {
                    _globals.linkItm.attr('href', 'css/not-min/skins/green.css');
                }

                if($(this).hasClass('yellow')) {
                    _globals.linkItm.attr('href', 'css/not-min/skins/yellow.css');
                }

                if($(this).hasClass('red')) {
                    _globals.linkItm.attr('href', 'css/not-min/skins/red.css');
                }

                if($(this).hasClass('grey')) {
                    _globals.linkItm.attr('href', 'css/not-min/skins/grey.css');
                }
            });

        },

        _setBinds = function () {
            
        },

        _binds = function () {

        },

        _triggers = function () {
            return {

            }
        },

        _toggleMenuCheckup = function () {

        },

        _setCustomMethods = function () {
            _colorSwitch.globals.customResurrect = function () {}
            _colorSwitch.globals.customDestroy = function () {}
        }

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