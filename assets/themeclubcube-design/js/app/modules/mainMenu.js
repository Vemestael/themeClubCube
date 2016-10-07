"use strict";
appMakeBeCool.gateway.addClass('MainMenu', function (properties, $, $window, $document) {
    var _mainMenu = this,
        _d = {
            header: '#header',
            headerToggleBtn: '#header-toggle',
            headerMenu: '#header-menu',
            headerCloseBtn: '#header-close',
            aboutPromo: '#about-promo'
        },
        _p = $.extend(_d, properties),
        _g = {
            header: null,
            headerToggleBtn: null,
            headerMenu: null,
            headerCloseBtn: null,
            aboutPromo: null,
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_mainMenu, [_p]);
            if (!_g.preloaded) {
                return _mainMenu.init();
            }
            _mainMenu.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _mainMenu.create();
        },

        _config = function () {
            _g.header = $(_p.header);
            _g.headerToggleBtn = $(_p.headerToggleBtn);
            _g.headerMenu = $(_p.headerMenu);
            _g.headerCloseBtn = $(_p.headerCloseBtn);
            _g.aboutPromo = $(_p.aboutPromo);
        },

        _setup = function () {
        },

        _setBinds = function () {
            _binds().setScrollBind();
            _binds().setOpenMenuBind();
            _binds().setCloseMenuBind();
        },

        _binds = function () {
            return {
                setScrollBind: function () {
                    _mainMenu.bind($window, 'scroll', function (e, data, el) {
                        console.log('Wee');
                        _mainMenu.globals.fixedHeaderOrNot();
                    });
                },
                setOpenMenuBind: function () {
                    _mainMenu.bind(_g.headerToggleBtn, 'click', function (e, data, el) {
                        _mainMenu.globals.openMenu();
                    });
                },
                setCloseMenuBind: function () {
                    _mainMenu.bind(_g.headerCloseBtn, 'click', function (e, data, el) {
                        _mainMenu.globals.closeMenu();
                    });
                },
            };
        },

        _triggers = function () {
            return {};
        },

        _setCustomMethods = function () {
            _mainMenu.globals.customResurrect = function () {
            };
            _mainMenu.globals.customDestroy = function () {
            };
            _mainMenu.globals.fixedHeaderOrNot = function () {
                var windowScroll = $window.scrollTop();
                if (windowScroll > (_g.aboutPromo.offset().top + _g.aboutPromo.outerHeight())) {
                    _g.header.addClass('header--fixed');
                } else {
                    _g.header.removeClass('header--fixed');
                }
            };
            _mainMenu.globals.openMenu = function () {
                _g.header.addClass('header--active');
            };
            _mainMenu.globals.closeMenu = function () {
                _g.header.removeClass('header--active');
            };
        };

    //PUBLIC METHODS
    _mainMenu.addMethod('init', function () {
        _mainMenu.bind($window, _mainMenu.globals.classType + '_Init', function (e, data, el) {
            _g.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});