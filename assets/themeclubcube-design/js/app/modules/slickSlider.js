"use strict";
appMakeBeCool.gateway.addClass('SlickSlider', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _slickSlider = this,
    _defaults = {
        videoSlider: '.b-video-item__slider',
        videoRefresh: '.video-refresh',
        videoRefreshAnim: '.video-refresh:before',
        // elements
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        videoSlider: null,
        videoRefresh: null,
        videoRefreshAnim: null,
        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_slickSlider, [_properties]);
        if(!_globals.preloaded) {
            return _slickSlider.init();
        }
        _slickSlider.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _slickSlider.create();
    },

    _config = function() {
        _globals.videoSlider = $(_properties.videoSlider);
        _globals.videoRefresh = $(_properties.videoRefresh);
        _globals.videoRefreshAnim = $(_properties.videoRefreshAnim);
    },

    _setup = function() {
        _globals.videoSlider.slick({
            nextArrow: _globals.videoRefresh,
            fade: true,
            infinite: true
        });

    },

    _setBinds = function() {},

    _binds = function() {
        return {};
    },

    _triggers = function(){
        return {};
    },

    _setCustomMethods = function() {
        _slickSlider.globals.customResurrect = function() {};
        _slickSlider.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _slickSlider.addMethod('init', function() {
        _slickSlider.bind($window, _slickSlider.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});