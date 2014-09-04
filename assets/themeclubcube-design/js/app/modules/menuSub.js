appMakeBeCool.gateway.addClass('MenuSub', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _menuSub = this,
    _defaults = {
        // elements
        nav: '#articleNav',
        closeButton: '.overlay-close-button',
        upButton: '.overlay-up-button',

        // classes ans styles
        classFixed: 'fixed',
        classSmall: 'smaller'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        nav: null,
        htmlBody: $('html,body'),

        // prop
        small: false,
        tempScrollTop: 0,
        currentScrollTop: 0,
        fixedScrollTop: 150,
        heightNav: -84,
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_menuSub, [_properties]);
        if(!_globals.preloaded) {
            return _menuSub.init();
        }
        _menuSub.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _menuSub.create();
    },

    _config = function() {
        _globals.nav = $(_properties.nav);
        _globals.small = true;
    },

    _setup = function() {
        _globals.nav.css({'margin-top':3*_globals.heightNav});
        _setClasses();
    },

    _setBinds = function() {
        _binds().setScrollBinds();
        _binds().setCloseButtonBinds();
        _binds().setUpButtonBinds();
        _binds().setSetupBinds();
        _binds().setUnSetBinds();
    },

    _binds = function() {
        return {
            setScrollBinds: function() {
                _menuSub.bind($window, 'scroll', function(e, data, el) {
                    _setClasses();
                });
            },
            setCloseButtonBinds: function() {
                $document.on('click', _properties.closeButton, function(e, data, el) {
                    e.preventDefault();
                    _triggers().getCloseButtonTrigger();
                });
            },
            setUpButtonBinds: function() {
                $document.on('click', _properties.upButton, function(e, data, el) {
                    e.preventDefault();
                    _globals.htmlBody.animate({scrollTop: 0}, 700);
                });
            },
            setSetupBinds: function() {
                _menuSub.bind($window, _menuSub.globals.classType+'_Setup', function(e, data, el) {
                    var _options = $.extend({noAjax: false}, data);
                    _config();
                    _setup();
                    _openNav();
                    if(_options.noAjax){
                        _unBindClose();
                    }
                });
            },
            setUnSetBinds: function() {
                _menuSub.bind($window, _menuSub.globals.classType+'_UnSet', function(e, data, el) {
                    _unsetNav();

                });
            }
        };
    },

    _triggers = function(){
        return {
            getCloseButtonTrigger: function(data){
                _menuSub.trigger(_menuSub.globals.classType+'_CloseButton', data);
            }
        }
    },

    _setCustomMethods = function() {
        _menuSub.globals.customResurrect = function() {};
        _menuSub.globals.customDestroy = function() {};
    },

    _openNav = function(){
        _globals.nav.animate({'margin-top':_globals.heightNav}, 1000, function(){
            _globals.nav.attr('style', '');
        });
    },

    _setClasses = function(ob){
        _globals.currentScrollTop = $window.scrollTop();
        if (_globals.tempScrollTop < _globals.currentScrollTop && _globals.currentScrollTop > _globals.fixedScrollTop && _globals.small){
            _globals.nav.addClass(_properties.classFixed);
        } else if (_globals.tempScrollTop > _globals.currentScrollTop && _globals.small){
            _globals.nav.removeClass(_properties.classFixed);
        }
        _globals.tempScrollTop = _globals.currentScrollTop;

        if ( $window.scrollTop() > 10 && _globals.small) {
            _globals.nav.addClass(_properties.classSmall);

        } else if($window.scrollTop() <= 10 && _globals.small) {
            _globals.nav.removeClass(_properties.classSmall);
        }
    },

    _unsetNav = function() {
        _globals.nav = null;
        _globals.small = false;
        _setClasses();

    },

    _unBindClose = function(){
        $(_properties.closeButton).unbind('click');
        $document.on('click', _properties.closeButton, function(e, data, el) {
            window.location = $(this).attr('href');
        });
    };

    //PUBLIC METHODS
    _menuSub.addMethod('init', function() {
        _menuSub.bind($window, _menuSub.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});
