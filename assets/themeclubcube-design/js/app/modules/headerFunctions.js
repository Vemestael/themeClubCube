"use strict";
appMakeBeCool.gateway.addClass('HeaderFunctions', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _headerFunctions = this,
        _defaults = {
            header: '.header',
            navbar: '#navbarCollapse',
            navbarToggle: '#navbarToogle',
            topbar: '.b-topbar',
            commerceNavtop: '.commerceNavtop',
            navbarColl: '.navbar-left',
            navComm: '.nav-commerce',
            navbarDisp: '.navbar__tint--disp',
            navbarDropMenu: '.navbar-open',
            navCollapse: '.navbar-collapse__m2',
            navHeadwrap: '.navbar-header__wrap',
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            header: null,
            navbar: null,
            navbarToggle: null,
            topbar: null,
            commerceNavtop: null,
            navbarColl: null,
            navComm: null,
            navbarDisp: null,
            navbarDropMenu: null,
            navCollapse: null,
            navHeadwrap: null,
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
            _globals.topbar = $(_properties.topbar);
            _globals.commerceNavtop = $(_properties.commerceNavtop);
            _globals.navbarColl = $(_properties.navbarColl);
            _globals.navComm = $(_properties.navComm);
            _globals.navbarDisp = $(_properties.navbarDisp);
            _globals.navbarDropMenu = $(_properties.navbarDropMenu);
            _globals.navCollapse = $(_properties.navCollapse);
            _globals.navHeadwrap = $(_properties.navHeadwrap);

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
                _globals.topbar.slideUp("normal");
                _globals.navbarDropMenu.addClass('dropdown-menu__right');
                _globals.navHeadwrap.addClass('navbar-brand--hide');
                _globals.commerceNavtop.css({
                    'margin-top' : '-41px'
                });
                _globals.navbarDisp.css({
                    "display" : "block"
                });
                _globals.navbarColl.css({
                    'float' : 'right'
                });
                $('.topbar-contact-dsp').css({
                    'line-height' : '50px'
                });
            } else {
                _globals.header.removeClass('header__sticky');
                _globals.topbar.slideDown("normal");
                _globals.navbarDropMenu.removeClass('dropdown-menu__right');
                _globals.navHeadwrap.removeClass('navbar-brand--hide');
                _globals.commerceNavtop.css({
                    'margin-top' : 'inherit'
                });
                _globals.navbarColl.css({
                    'float' : 'none'
                });
                _globals.navbarDisp.css({
                    "display" : "none"
                });
                $('.topbar-contact-dsp').css({
                    'line-height' : '80px'
                });
            }
            if ($(window).width() < 1280) {
                if (offsetop > _globals.header.height()) {
                    _globals.navCollapse.addClass('navbar-collapse--down');
                    _globals.navCollapse.removeClass('navbar-collapse--top');
                } else {
                    _globals.navCollapse.addClass('navbar-collapse--top');
                    _globals.navCollapse.removeClass('navbar-collapse--down');
                }

            }
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