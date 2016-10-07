appMakeBeCool.gateway.addClass('EventAnimate', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _eventAnimate = this,
    _defaults = {
        // elements
        events: '.top-event'

        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        events: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_eventAnimate, [_properties]);
        if(!_globals.preloaded) {
            return _eventAnimate.init();
        }
        _eventAnimate.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _eventAnimate.create();
    },

    _config = function() {
        _globals.events = $(_properties.events);
    },

    _setup = function() {
        if(_globals.events.length){
            new EventAnimate( _globals.events);
        }
    },

    _setBinds = function() {},

    _binds = function() {
        return {};
    },

    _triggers = function(){
        return {};
    },

    _setCustomMethods = function() {
        _eventAnimate.globals.customResurrect = function() {};
        _eventAnimate.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _eventAnimate.addMethod('init', function() {
        _eventAnimate.bind($window, _eventAnimate.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});