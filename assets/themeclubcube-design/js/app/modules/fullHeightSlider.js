appMakeBeCool.gateway.addClass('FullHeightSlider', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _fullHeightSlider = this,
        _defaults = {
            // elements
            slider: '#fullHeghtSlider',
            imgSlider: '#fullHeghtSlider .container-fluidss img.img-responsive',
            videos: '.video-bg',
            rowss: '.rowss',
            // prop
            // data
            // classes ans styles
            sliderClass: 'slider',
            tileClass: '.bg-tile',
            sliderDefaultClass: 'slider-default',
            imgResponsiveClass: 'img-responsive',
            heightToWindowClass: 'height-to-window'
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            slider: null,
            imgSlider: null,
            videos: null,
            tileSlide: null,
            rowss: null,

            // prop
            windowHeight: 0,
            windowWidth: 0,
            sliderHeight: 0,
            slideNodeHeight: 0,
            preloaded: false
        },

        //PRIVATE METHODS
        _init = function() {
            appMakeBeCool.gateway.base.Class.apply(_fullHeightSlider, [_properties]);
            if (!_globals.preloaded) {
                return _fullHeightSlider.init();
            }
            _fullHeightSlider.globals.customCreate = function() {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _fullHeightSlider.create();
        },

        _config = function() {
            _globals.slider = $(_properties.slider);
            _globals.sliderFullHeight = $('.' + _properties.sliderClass);
            _globals.sliderDefault = $('.' + _properties.sliderDefaultClass);
            _globals.imgSlider = $(_properties.imgSlider);
            _globals.videos = $(_properties.videos);
            _globals.rowss = $(_properties.rowss);
            _globals.tileNode = $(_properties.tileClass);
            _globals.windowHeight = $window.height();
            _globals.windowWidth = $window.width();
        },

        _setup = function() {
            if (_globals.slider.length) {
                if (_globals.slider.hasClass(_properties.sliderClass)) {
                    _triggers().bigSlider();
                }
                _globals.sliderHeight = _globals.slider.height();
                _globals.slideNodeHeight = _globals.rowss.height();

                var sliderTopPadding = (_globals.sliderHeight - _globals.slideNodeHeight) / 2;

                if ((_globals.slideNodeHeight < _globals.sliderHeight) && (_globals.sliderFullHeight.length)) {
                    _globals.rowss.css('top', sliderTopPadding + (_globals.slider.hasClass(_properties.sliderDefaultClass) ? 10 : 40));
                } else if ((_globals.slideNodeHeight < _globals.windowHeight) && (_globals.sliderDefault.length)) {
                    _globals.rowss.css('top', (_globals.sliderHeight - _globals.slideNodeHeight) / 2 - 20);
                } else {
                    _globals.rowss.css('top', '130px');
                }
                if ((_globals.slideNodeHeight < _globals.sliderHeight) && (window.devicePixelRatio === 2) && ((_globals.windowWidth) === 1024)) {
                    _globals.rowss.css('top', ((_globals.sliderHeight / 2 - _globals.slideNodeHeight)) + 40);
                }

                var tileOptions = {};
                if (_globals.slider.hasClass(_properties.sliderDefaultClass)) {
                    tileOptions = {
                        dots: true
                    }
                }
                if (!$('.bg-tile').length) {
                    _globals.tileSlide = new TileSlide(document.querySelector(_properties.slider), tileOptions);
                }
                _globals.imgSlider.each(function() {
                    var node = this;
                    _changeClass(node);
                });
            }
            // _addVideos();
        },

        _setBinds = function() {
            _binds().setResizeBind();
            _binds().setActionBind();
        },

        _binds = function() {
            return {
                setResizeBind: function() {
                    _fullHeightSlider.bind($window, 'resize', function(e, data, el) {
                        _setup();
                    })
                },
                setActionBind: function() {
                    _fullHeightSlider.bind($window, _fullHeightSlider.globals.classType + '_Action', function(e, data, el) {
                        var _options = $.extend({
                            action: 'play'
                        }, data);
                        if (_globals.tileSlide) {
                            if (_options.action == 'stop') {
                                _globals.tileSlide.stopSlide();
                            } else if (_options.action == 'play') {
                                _globals.tileSlide.playSlide();
                            }
                        }
                    })
                }
            };
        },

        _triggers = function() {
            return {
                bigSlider: function(data) {
                    _fullHeightSlider.trigger(_fullHeightSlider.globals.classType + '_BigSlider', data);
                }
            };
        },

        _changeClass = function(node) {
            if (_globals.windowHeight > _globals.windowWidth && _globals.slider.hasClass(_properties.sliderClass)) {
                $(node).removeClass(_properties.imgResponsiveClass).addClass(_properties.heightToWindowClass);
            }
            if (_globals.windowHeight < _globals.windowWidth && _globals.slider.hasClass(_properties.sliderClass)) {
                $(node).removeClass(_properties.imgResponsiveClass).addClass(_properties.heightToWindowClass);
            }
            if ((_globals.windowHeight < 1200) && _globals.slider.hasClass(_properties.sliderDefaultClass)) {
                $(node).removeClass(_properties.imgResponsiveClass).addClass(_properties.heightToWindowClass);
            }
        },

        _addVideos = function() {
            if (window.innerWidth > window.innerHeight) {
                _globals.videos.width(document.body.clientWidth);
                _globals.videos.height((document.body.clientWidth / 1.77) + 40);
            } else {
                _globals.videos.width(window.innerWidth);
                _globals.videos.height(window.innerHeight + 40);
            };
        }

    _setCustomMethods = function() {
        _fullHeightSlider.globals.customResurrect = function() {};
        _fullHeightSlider.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _fullHeightSlider.addMethod('init', function() {
        _fullHeightSlider.bind($window, _fullHeightSlider.globals.classType + '_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});