appMakeBeCool.gateway.addClass('MenuSlick', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _menuSlick = this,
    _defaults = {
        // elements
        nav: '#header',
        btnNav: '#btnShow',
        containerNav: '#navigation',

        // classes ans styles
        classHide: 'slick',
        classSmall: 'smaller'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        nav: null,
        btnNav: null,
        containerNav: null,

        // prop
        small: false,
        tempScrollTop: 0,
        currentScrollTop: 0,
        fixedScrollTop: 350,
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_menuSlick, [_properties]);
        if(!_globals.preloaded) {
            return _menuSlick.init();
        }
        _menuSlick.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _menuSlick.create();
    },

    _config = function() {
        _globals.nav = $(_properties.nav);
        _globals.btnNav = $(_properties.btnNav);
        _globals.containerNav = $(_properties.containerNav);
    },

    _setup = function() {

    },

    _setBinds = function() {
        _binds().setScrollBinds();
        _binds().setBtnNavBinds();
    },

    _binds = function() {
        return {
            setScrollBinds: function() {
                _menuSlick.bind($window, 'scroll', function(e, data, el) {
                    _setClasses();
                });
            },
            setBtnNavBinds: function() {
                _menuSlick.bind(_globals.btnNav, 'click', function(e, data, el) {
                    _globals.btnNav.toggleClass("active");
                    _globals.containerNav.toggleClass("active");
                });
            }
        };
    },

    _setCustomMethods = function() {
        _menuSlick.globals.customResurrect = function() {};
        _menuSlick.globals.customDestroy = function() {};
    },

    _setClasses = function(ob){
        _globals.currentScrollTop = $window.scrollTop();
        if (_globals.tempScrollTop < _globals.currentScrollTop && _globals.currentScrollTop > _globals.fixedScrollTop){
            _globals.nav.addClass(_properties.classHide);
        } else if (_globals.tempScrollTop > _globals.currentScrollTop){
            _globals.nav.removeClass(_properties.classHide);
        }
        _globals.tempScrollTop = _globals.currentScrollTop;

        if ( $window.scrollTop() > 10 ) {
            _globals.nav.addClass(_properties.classSmall);

        } else if($window.scrollTop() <= 10 ) {
            _globals.nav.removeClass(_properties.classSmall);
        }
    };

    //PUBLIC METHODS
    _menuSlick.addMethod('init', function() {
        _menuSlick.bind($window, _menuSlick.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});
