appMakeBeCool.gateway.addClass('TicketsEventsSlider', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _ticketsEventsSlider = this,
        _defaults = {
            // elements
            slider: '#ticketsSlider',
            defaultSlider: '.default-slider-tickets'
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            slider: null,
            defaultSlider: null,
            // prop
            preloaded: false
        },

        //PRIVATE METHODS
        _init = function() {
            appMakeBeCool.gateway.base.Class.apply(_ticketsEventsSlider, [_properties]);
            if (!_globals.preloaded) {
                return _ticketsEventsSlider.init();
            }
            _ticketsEventsSlider.globals.customCreate = function() {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _ticketsEventsSlider.create();
        },

        _config = function() {
            _globals.slider = $(_properties.slider);
            _globals.defaultSlider = $(_properties.defaultSlider);
        },

        _setup = function() {
            if ((_globals.slider.length) && (!_globals.slider.hasClass(_properties.defaultSlider))) {
                _globals.slider.slick({
                    slidesToShow: 1,
                    dots: false,
                    easing: 'easeInExpo',
                    autoplay: false,
                    autoplaySpeed: 4200,
                    pauseOnHover: false,
                    draggable: false,
                    infinite: false,
                    speed: 300,
                    vertical: true
                });
            } else if ((_globals.slider.length) && (_globals.slider.hasClass(_properties.defaultSlider))) {
                _globals.slider.slick({
                    slidesToShow: 1,
                    dots: false,
                    easing: 'easeInExpo',
                    autoplay: false,
                    arrows: true,
                    autoplaySpeed: 4200,
                    pauseOnHover: false,
                    draggable: false,
                    infinite: false,
                    speed: 300,
                    vertical: true,
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                            arrows:true,
                            slidesToShow: 1,
                            infinite: false,
                            dots: false
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            arrows:true,
                            slidesToShow: 1,
                            infinite: false,
                            dots: false
                        }
                    }, {
                        breakpoint: 320,
                        settings: {
                            arrows:false,
                            slidesToShow: 1,
                            infinite: false,
                            dots: false
                        }
                    }]
                });
            }
        },

        _setBinds = function() {
            _binds().setResizeBind();
        },

        _binds = function() {
            return {
                setResizeBind: function() {
                    _ticketsEventsSlider.bind($window, 'resize', function(e, data, el) {
                        _setup();
                    })
                }
            };
        },

        _triggers = function() {
            return {};
        },

        _setCustomMethods = function() {
            _ticketsEventsSlider.globals.customResurrect = function() {};
            _ticketsEventsSlider.globals.customDestroy = function() {};
        };

    //PUBLIC METHODS
    _ticketsEventsSlider.addMethod('init', function() {
        _ticketsEventsSlider.bind($window, _ticketsEventsSlider.globals.classType + '_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});