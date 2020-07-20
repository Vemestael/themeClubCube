"use strict";
appMakeBeCool.gateway.addClass('MenuAligns', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _menuAligns = this,
        _defaults = {
            navigation: '#navigation'
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            navigation: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_menuAligns, [_properties]);
            if (!_globals.preloaded) {
                return _menuAligns.init();
            }
            _menuAligns.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _menuAligns.create();
        },

        _config = function () {
            _globals.navigation = $(_properties.navigation);
        },

        _setup = function () {
            if ($window.width() >= 1200 && _globals.navigation.length) {
                _testRigthSpace();
            }
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {};
        },

        _triggers = function () {
            return {};
        },

        _testRigthSpace = function () {
            var $navigLi = _globals.navigation.children('li');
            $navigLi.each(function () {
                var thisLeftOffset = $(this).offset().left;
                var windowWidth = $window.width();
                var $firstUl = $(this).children('.navbar-dropdown__menu');
                var $secondUl = $firstUl.find('.navbar-list__inner');
                var firstUlWidth = $firstUl.outerWidth();
                var secondUlWidth = 0;
                var thisUlWidth = 0;
                if ($secondUl.length) {
                    $firstUl.css({
                        visibility: "hidden",
                        display: "block"
                    });
                    $secondUl.css({
                        visibility: "hidden",
                        display: "block"
                    });
                    secondUlWidth = $secondUl.outerWidth();
                    $firstUl.css({
                        visibility: "",
                        display: ""
                    });
                    $secondUl.css({
                        visibility: "",
                        display: ""
                    });
                    thisUlWidth = firstUlWidth + secondUlWidth;
                } else {
                    thisUlWidth = firstUlWidth;
                }
                if ((thisLeftOffset + thisUlWidth) >= windowWidth) {
                    $firstUl.addClass('dropdown-menu__right');
                } else if ($('body').hasClass('body-boxed')) {
                    $firstUl.addClass('dropdown-menu__right');
                    console.log(windowWidth)
                }
            });


        },

        _setCustomMethods = function () {
            _menuAligns.globals.customResurrect = function () {
            };
            _menuAligns.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _menuAligns.addMethod('init', function () {
        _menuAligns.bind($window, _menuAligns.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});