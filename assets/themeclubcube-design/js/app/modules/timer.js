"use strict";
appMakeBeCool.gateway.addClass('Timer', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _timer = this,
    _defaults = {
        timerBlock: '.b-timer',
        // elements
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        timerBlock: null,
        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_timer, [_properties]);
        if(!_globals.preloaded) {
            return _timer.init();
        }
        _timer.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _timer.create();
    },

    _config = function() {
        _globals.timerBlock = $(_properties.timerBlock);
    },

    _setup = function() {
        countdownTimer();
    },

    _setBinds = function() {},

    _binds = function() {
        return {};
    },

    _triggers = function(){
        return {};
    },

    countdownTimer = function() {
        var year = _globals.timerBlock.data('year'),
            month = _globals.timerBlock.data('month'),
            day = _globals.timerBlock.data('day'),
            hour = _globals.timerBlock.data('hour'),
            minute = _globals.timerBlock.data('minute');

        _globals.timerBlock.syotimer({
            year: year,
            month: month,
            day: day,
            hour: hour,
            minute: minute,
        });
    },

    _setCustomMethods = function() {
        _timer.globals.customResurrect = function() {};
        _timer.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _timer.addMethod('init', function() {
        _timer.bind($window, _timer.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});