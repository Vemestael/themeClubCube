appMakeBeCool.gateway.addClass('ScrollAtOnce', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _scrollAtOnce = this,
    _defaults = {
        // elements
        slider: '#fullHeghtSlider',
        topEvents: '#topEvents',
        gallery: '#galleryIndex',
        blog: '#blogIndex',
        scrollDownButt: '#scrollDownButt',
        header: 'header',

        // prop
        // data
        // classes ans styles
        headerClass: 'header-top active'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        slider: null,
        topEvents: null,
        gallery: null,
        blog: null,
        scrollDownButt: null,
        header: null,
        body: null,

        // prop
        scrollTopValue: 0,
        scrollToggle: false,
        scrollDirection: null,
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_scrollAtOnce, [_properties]);
        if(!_globals.preloaded) {
            return _scrollAtOnce.init();
        }
        _scrollAtOnce.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _scrollAtOnce.create();
    },

    _config = function() {
        _globals.slider = $(_properties.slider);
        _globals.topEvents = $(_properties.topEvents);
        _globals.gallery = $(_properties.gallery);
        _globals.blogs = $(_properties.blog);
        _globals.scrollDownButt = $(_properties.scrollDownButt);
        _globals.header = $(_properties.header);
        _globals.body = $('body');
    },

    _setup = function() {
        if ($document.scrollTop() === 0) {
            _setDefaultPositions();
        }
    },

    _setBinds = function() {
        _binds().setScrollDownButtBind();
        _binds().setScrollBind();
        _binds().setMousewheelBind();
    },

    _binds = function() {
        return {
            setScrollDownButtBind: function(){
                _scrollAtOnce.bind(_globals.scrollDownButt, 'click', function(e, data, el) {
                    _globals.scrollToggle = true;

                    $('html,body').stop().animate({
                        scrollTop: $window.height()
                    }, 600);

                    var options = {action:'stop'}
                    _triggers().scrollToggle(options);
                    setTimeout(function() {
                        _setCustomPositions();
                        _globals.header.addClass(_properties.headerClass);
                        $window.unbind('DOMMouseScroll mousewheel');
                    }, 600);
                });
            },
            setScrollBind: function(){
                _scrollAtOnce.bind($window, 'scroll', function(e, data, el) {
                    var _scrollValue = $window.scrollTop();
                    if (($window.scrollTop() >= _globals.slider.outerHeight()) && (_scrollValue > _globals.scrollTopValue) && (_globals.scrollToggle === false)) {
                        _globals.scrollToggle = true;
                        _setCustomPositions();
                        _globals.header.addClass(_properties.headerClass);
                        // Pause slider
                        var options = {action:'stop'}
                        _triggers().scrollToggle(options);
                    } else if (($window.scrollTop() <= _globals.slider.outerHeight()) && (_scrollValue < _globals.scrollTopValue) && (_globals.scrollToggle === true)) {
                        _globals.scrollToggle = false;
                        _setDefaultPositions();
                        _globals.header.removeClass(_properties.headerClass);
                        // Autoplay slider
                        var options = {action:'play'}
                        _triggers().scrollToggle(options);
                    }
                    _globals.scrollTopValue = _scrollValue;
                });
            },
            setMousewheelBind: function(){
                _globals.body.on('DOMMouseScroll mousewheel', function(event) {
                    if (event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0) {
                        _globals.scrollDirection = 'down';
                    } else {
                        _globals.scrollDirection = 'up';
                    };
                    if (($document.scrollTop() === 0) && (_globals.scrollDirection === 'down')) {
                        $('html,body').stop().animate({
                            scrollTop: $window.height()
                        }, 600);

                        $window.bind('DOMMouseScroll mousewheel', function(event) {
                            event.preventDefault();
                        });
                        setTimeout(function() {
                            _setCustomPositions();
                            _globals.header.addClass(_properties.headerClass);
                            $window.unbind('DOMMouseScroll mousewheel');
                        }, 600);

                        // Pause slider
                        _globals.scrollToggle = true;
                        var options = {action:'stop'}
                        _triggers().scrollToggle(options);
                        return false;
                    } else if (($document.scrollTop() <= (_globals.slider.height())) && (_globals.scrollDirection === 'up')) {
                        _setDefaultPositions();
                        _globals.header.removeClass(_properties.headerClass);
                        $window.bind('DOMMouseScroll mousewheel', function(event) {
                            event.preventDefault();
                        });

                        // Unbind scroll disable
                        setTimeout(function() {
                            $window.unbind('DOMMouseScroll mousewheel');
                        }, 600);
                        $('html,body').stop().animate({
                            scrollTop: 0
                        }, 600);

                        // Autoplay slider
                        var options = {action:'play'}
                        _triggers().scrollToggle(options);
                        _globals.scrollToggle = false;
                        return false;
                    };
                });
            }
        };
    },

    _triggers = function(){
        return {
            scrollToggle: function(data){
                _scrollAtOnce.trigger(_scrollAtOnce.globals.classType+'_Toggle', data);
            }
        };
    },

    _setDefaultPositions = function(){
        _globals.slider.css({
            zIndex: 11
        });
        _globals.topEvents.css({
            position: 'fixed',
            width: '100%',
            top: 0,
            left: 0
        });
        _globals.gallery.css({
            position: 'fixed',
            width: '100%',
            top: _globals.topEvents.outerHeight(),
            left: 0
        });
        _globals.blogs.css({
            marginTop: _globals.topEvents.outerHeight() + _globals.gallery.outerHeight()
        });
    },

    _setCustomPositions = function(){
        _globals.topEvents.css({
            position: 'relative'
        });
        _globals.gallery.css({
            position: 'relative',
            top: 0
        });
        _globals.blogs.css({
            marginTop: 0
        });
    },

    _setCustomMethods = function() {
        _scrollAtOnce.globals.customResurrect = function() {};
        _scrollAtOnce.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _scrollAtOnce.addMethod('init', function() {
        _scrollAtOnce.bind($window, _scrollAtOnce.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});