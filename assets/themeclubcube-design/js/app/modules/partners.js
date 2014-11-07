appMakeBeCool.gateway.addClass('Partners', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _partners = this,
        _defaults = {
            // elements
            partners: '#partnersSlider'
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            partners: null,

            // prop
            preloaded: false
        },

        //PRIVATE METHODS
        _init = function() {
            appMakeBeCool.gateway.base.Class.apply(_partners, [_properties]);
            if (!_globals.preloaded) {
                return _partners.init();
            }
            _partners.globals.customCreate = function() {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _partners.create();
        },

        _config = function() {
            _globals.partners = $(_properties.partners);
        },

        _setup = function() {
            _partnersSlider();
        },

        _setBinds = function() {},

        _binds = function() {
            return {
                setResizeBind: function() {
                    _partners.bind($window, 'resize', function(e, data) {
                        _partnersSlider();
                    });
                }
            };
        },

        _triggers = function() {
            return {};
        },

        _partnersSlider = function() {
            // if (window.innerWidth < 768) {
            _globals.partners.slick({
                // dots: false,
                // infinite: false,
                // speed: 400,
                // slidesToShow: 1,
                // touchMove: false,
                // slidesToScroll: 1
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                pauseOnHover: false,
                touchMove: false,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        dots: true
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        dots: false,
                        infinite: false,
                        speed: 400,
                        slidesToShow: 1,
                        touchMove: false,
                        slidesToScroll: 1,
                    }
                }]
            });
            // } else {
            //     _globals.partners.slick({
            //         dots: false,
            //         infinite: false,
            //         speed: 300,
            //         slidesToShow: 5,
            //         touchMove: false,
            //         slidesToScroll: 1
            //     });
            // }
        },

        _setCustomMethods = function() {
            _partners.globals.customResurrect = function() {};
            _partners.globals.customDestroy = function() {};
        };

    //PUBLIC METHODS
    _partners.addMethod('init', function() {
        _partners.bind($window, _partners.globals.classType + '_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});