appMakeBeCool.gateway.addClass('LoaderMain', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _loaderMain = this,
        _defaults = {
        // elements
        container: '#loaderContainer',
        loader: '#loader',

        // classes ans styles
        activeClass: 'active',

        // prop
        durationTiles: 300,
        duration: 1000
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        container: null,
        loader: null,
        tiles: null,

        // data
        interval: null,

        // prop
        current: 0,
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_loaderMain, [_properties]);
        if(!_globals.preloaded) {
            return _loaderMain.init();
        }
        _loaderMain.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _loaderMain.create();
    },

    _config = function() {
        _globals.container = $(_properties.container);
        _globals.loader = $(_properties.loader);
        _globals.tiles = _globals.loader.children();
    },

    _setup = function() {
        _globals.interval = _loaderMain.setInterval(function() {
            _globals.tiles.removeClass(_properties.activeClass);
            $(_globals.tiles[_globals.current]).addClass(_properties.activeClass);
            _globals.current++;
            if (_globals.current > 3) {
                _globals.current = 0;
            };
        }, _properties.durationTiles);
    },

    _setBinds = function() {
        _binds().setStartAnimationBind();
        _binds().setEndAnimationBind();
    },

    _binds = function() {
        return {
            setStartAnimationBind: function() {
                _loaderMain.bind($window, _loaderMain.globals.classType+'_Start', function(e, data, el) {
                    _globals.container.fadeIn(_properties.duration);
                    _setup();
                });
            },
            setEndAnimationBind: function() {
                _loaderMain.bind($window, _loaderMain.globals.classType+'_End', function(e, data, el) {
                    _loaderMain.clearInterval(_globals.interval);
                    _globals.container.fadeOut(1000);
                });
            }
        };		
    },

    _setCustomMethods = function() {
        _loaderMain.globals.customResurrect = function() {};
        _loaderMain.globals.customDestroy = function() {};
    };
    
    //PUBLIC METHODS
    _loaderMain.addMethod('init', function() {
        _loaderMain.bind($window, _loaderMain.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});