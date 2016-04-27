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

            _globals.item.each(function() {
                $(this).on('mousemove', function(e) {
                  if($(this).height() < $(this).find('.img-block img').height()) {

                    var img = $(this).find('.img-block img');
                    var mcoord = e.offsetY==undefined?e.layerY:e.offsetY;
                    var imgOff = 100 - ($(this).height() / img.height() * 100);
                    var offsetY = (mcoord / $(this).height() * imgOff);

                    var toTop = (-offsetY) + '%';
                    img.css({
                      'top' : toTop
                    });
                    } else {
                        $(this).find('.img-block img').css({'position' : 'static'});
                    }
                });
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