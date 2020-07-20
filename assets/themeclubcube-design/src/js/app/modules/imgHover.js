"use strict";
appMakeBeCool.gateway.addClass('ImgHover', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _imgHover = this,
        _defaults = {
            item: '.page-item__inner'
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            item: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_imgHover, [_properties]);
            if (!_globals.preloaded) {
                return _imgHover.init();
            }
            _imgHover.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _imgHover.create();
        },

        _config = function () {
            _globals.item = $(_properties.item);
        },

        _setup = function () {
            _imgHoverFunc();
        },

        _setBinds = function () {
        },

        _binds = function () {

        },

        _triggers = function () {
            return {};
        },

        _imgHoverFunc = function () {

            function toBottom() {
                
            }

            function toTop() {

            }

            _globals.item.each(function() {
                if($(this).height() < $(this).find('.img-block img').height()) {
                    var img = $(this).find('.img-block img');
                    var imgOff = img.height() - $(this).height();
                    var toTop = (-imgOff) + 'px';
                    img.css({
                      'bottom' : toTop
                  }, 2000);
                } else {
                    $(this).find('.img-block img').css({'position' : 'static'});
                }
            });
        },

        _setCustomMethods = function () {
            _imgHover.globals.customResurrect = function () {
            };
            _imgHover.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _imgHover.addMethod('init', function () {
        _imgHover.bind($window, _imgHover.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});