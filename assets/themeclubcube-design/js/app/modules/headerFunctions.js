"use strict";
appMakeBeCool.gateway.addClass('HeaderFunctions', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _headerFunctions = this,
        _defaults = {
            header: '.header',
            navbar: '#navbarCollapse',
            navbarToggle: '#navbarToogle'
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            header: null,
            navbar: null,
            navbarToggle: null,
            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_headerFunctions, [_properties]);
            if (!_globals.preloaded) {
                return _headerFunctions.init();
            }
            _headerFunctions.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _headerFunctions.create();
        },

        _config = function () {
            _globals.header = $(_properties.header);
            _globals.navbar = $(_properties.navbar);
            _globals.navbarToggle = $(_properties.navbarToggle);

        },

        _setup = function () {
            _hoveredMenuNav();
        },

        _setBinds = function () {
            _binds().setNavbarToggle();
            _binds().setScrollHeader();
        },

        _binds = function () {
            return {
                setNavbarToggle: function () {
                    _headerFunctions.bind(_globals.navbarToggle, 'click', function (e, data, el) {
                        _headerFunctions.globals.navbarToggle();
                    })
                }
                , setScrollHeader: function () {
                    _headerFunctions.bind($window, 'scroll', function () {
                        _stickyHeader();
                    });
                }
            };
        },

        _triggers = function () {
            return {};
        },

        _stickyHeader = function () {
            var offsetop = $window.scrollTop();
            if (offsetop > _globals.header.height()) {
                _globals.header.addClass('header__sticky');
            } else (_globals.header.removeClass('header__sticky'))
        },

        _setCustomMethods = function () {
            _headerFunctions.globals.customResurrect = function () {
            };
            _headerFunctions.globals.customDestroy = function () {
            };
            _headerFunctions.globals.navbarToggle = function () {
                if (_globals.header.hasClass('header--toggled')) {
                    _globals.navbar.removeClass('active');
                    _globals.header.removeClass('header--toggled');
                } else {
                    _globals.navbar.addClass('active');
                    _globals.header.addClass('header--toggled');
                }
            };
        },

        _hoveredMenuNav = function () {
            $(".navbar-list > li").hover(function() {
                var hovered = $(this)
                    , timer = hovered.data("timer") || 0;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    hovered.addClass("active");
                }, 480);
                hovered.data("timer", timer);
            }, function() {
                var hovered = $(this)
                    , timer = hovered.data("timer") || 0;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    hovered.removeClass("active");
                }, 480);
                hovered.data("timer", timer);
            });
        };

    //PUBLIC METHODS
    _headerFunctions.addMethod('init', function () {
        _headerFunctions.bind($window, _headerFunctions.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});