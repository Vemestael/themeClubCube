appMakeBeCool.gateway.addClass('EventsTickets', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _eventsTickets = this,
    _defaults = {
        // elements
        tickets: '.ticket-event',
        // prop
        // data
        // classes ans styles
        lineUpClass: '.ticket-event-lineup',
        shClass: '.ticket-line-up.sh',
        hidClass: '.ticket-line-up.hid'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        tickets: null,
        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_eventsTickets, [_properties]);
        if(!_globals.preloaded) {
            return _eventsTickets.init();
        }
        _eventsTickets.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _eventsTickets.create();
    },

    _config = function() {
        _globals.tickets = $(_properties.tickets);
    },

    _setup = function() {
        if (_globals.tickets.length > 0) {
            _globals.tickets.mouseenter(function() {
                var width = $(this).find(_properties.lineUpClass).width();
                var outerWidth = $(this).find(_properties.lineUpClass).outerWidth();
                var $shNode = $(this).find(_properties.shClass);
                var $hdNode = $(this).find(_properties.hidClass);
                $shNode.stop();
                $hdNode.stop();
                $shNode.width(width);
                $hdNode.width(width);
                $shNode.animate({
                    left: -outerWidth
                }, 500);
                $hdNode.animate({
                    left: 0
                }, 500);
            }).mouseleave(function() {
                var outerWidth = $(this).find(_properties.lineUpClass).outerWidth();
                var $shNode = $(this).find(_properties.shClass);
                var $hdNode = $(this).find(_properties.hidClass);
                $shNode.stop();
                $hdNode.stop();
                $shNode.animate({
                    left: 0
                }, 500);
                $hdNode.animate({
                    left: outerWidth
                }, 500);
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
        _eventsTickets.globals.customResurrect = function() {};
        _eventsTickets.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _eventsTickets.addMethod('init', function() {
        _eventsTickets.bind($window, _eventsTickets.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});