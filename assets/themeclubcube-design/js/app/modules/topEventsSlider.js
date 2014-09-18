appMakeBeCool.gateway.addClass('TopEventsSlider', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _topEventsSlider = this,
    _defaults = {
        // elements
        slider: '#topEventsSliders'
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        slider: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_topEventsSlider, [_properties]);
        if(!_globals.preloaded) {
            return _topEventsSlider.init();
        }
        _topEventsSlider.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _topEventsSlider.create();
    },

    _config = function() {
        _globals.slider = $(_properties.slider);
    },

    _setup = function() {
        if(_globals.slider.length) {
            _globals.slider.slick({
                slidesToShow: 1,
                fade: true,
                dots: true,
                arrows: false,
                easing: 'easeInExpo',
                draggable: false,
                speed: 900,
                swipe: false
            });
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
        _topEventsSlider.globals.customResurrect = function() {};
        _topEventsSlider.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _topEventsSlider.addMethod('init', function() {
        _topEventsSlider.bind($window, _topEventsSlider.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});