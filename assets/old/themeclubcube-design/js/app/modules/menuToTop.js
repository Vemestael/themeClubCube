appMakeBeCool.gateway.addClass('MenuToTop', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _menuToTop = this,
        _defaults = {
            // elements
            header: '#header',
            headerSlider: '#fullHeghtSlider',

            // classes ans styles
            headerSliderClass: 'slider-default',
            navClass:'.navbar-collapse',
            class: 'header-top active',
            activeClass: 'active'
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            header: null,
            headerSlider: null,

            // prop
            headerSize: 0,
            preloaded: false
        },

        //PRIVATE METHODS
        _init = function() {
            appMakeBeCool.gateway.base.Class.apply(_menuToTop, [_properties]);
            if (!_globals.preloaded) {
                return _menuToTop.init();
            }
            _menuToTop.globals.customCreate = function() {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _menuToTop.create();
        },

        _config = function() {
            _globals.header = $(_properties.header);
            _globals.headerSlider = $(_properties.headerSlider);
            _globals.navBar = $(_properties.navClass);
        },

        _setup = function() {
            // _globals.headerSize = _globals.headerSlider.length != 0 ? _globals.headerSlider.height() : _globals.headerSlider.height();
            _globals.headerSize = _globals.header.height();
            // if ($(window).scrollTop() >= _globals.headerSize) {
            //     _globals.header.addClass(_properties.class);
            // };
            if (_globals.headerSlider.length) {
                if (($(window).scrollTop() > _globals.headerSlider.height()) && (!_globals.header.hasClass('header-top'))) {
                    _globals.header.addClass(_properties.class);
                    setTimeout(function() {
                        _globals.header.removeClass(_properties.activeClass);
                    }, 2000);
                };
            } else {
                if (!_globals.header.hasClass('header-top')) {
                    _globals.header.addClass(_properties.class);
                    setTimeout(function() {
                        _globals.header.removeClass(_properties.activeClass);
                    }, 2000);
                };
            };
        },

        _setBinds = function() {
            _binds().setScrollBinds();
        },

        _binds = function() {
            return {
                setScrollBinds: function() {
                    _menuToTop.bind($window, 'scroll', function(e, data, el) {
                        // if ($window.scrollTop() >= _globals.headerSize) {
                        //     _globals.header.addClass(_properties.class);
                        // } else if (_globals.headerSlider.length !== 0) {
                        //     _globals.header.removeClass(_properties.class);
                        // }
                        if (_globals.headerSlider.length) {
                            if (($(window).scrollTop() > _globals.headerSlider.height()) && (!_globals.header.hasClass('header-top'))) {
                                _globals.header.addClass(_properties.class);
                                setTimeout(function() {
                                    _globals.header.removeClass(_properties.activeClass);
                                }, 2000);
                            } else if (($(window).scrollTop() <= _globals.headerSize) && (_globals.header.hasClass('header-top')) && (!_globals.navBar.hasClass('in'))) {
                                _globals.header.removeClass(_properties.class);
                            };
                        } else {
                            if (!_globals.header.hasClass('header-top')) {
                                _globals.header.addClass(_properties.class);
                                setTimeout(function() {
                                    _globals.header.removeClass(_properties.activeClass);
                                }, 2000);
                            };
                        };
                    });
                }
            };
        },

        _setCustomMethods = function() {
            _menuToTop.globals.customResurrect = function() {};
            _menuToTop.globals.customDestroy = function() {};
        };

    //PUBLIC METHODS
    _menuToTop.addMethod('init', function() {
        _menuToTop.bind($window, _menuToTop.globals.classType + '_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});