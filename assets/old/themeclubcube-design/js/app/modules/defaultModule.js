appMakeBeCool.gateway.addClass('DefaultModule', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _defaultMudule = this,
    _defaults = {
        // elements
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_defaultMudule, [_properties]);
        if(!_globals.preloaded) {
            return _defaultMudule.init();
        }
        _defaultMudule.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _defaultMudule.create();
    },

    _config = function() {},

    _setup = function() {},

    _setBinds = function() {},

    _binds = function() {
        return {};
    },

    _triggers = function(){
        return {};
    },

    _setCustomMethods = function() {
        _defaultMudule.globals.customResurrect = function() {};
        _defaultMudule.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _defaultMudule.addMethod('init', function() {
        _defaultMudule.bind($window, _defaultMudule.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});