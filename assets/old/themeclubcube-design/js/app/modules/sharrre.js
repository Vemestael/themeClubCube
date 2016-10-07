appMakeBeCool.gateway.addClass('Sharrre', function(properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _sharrre = this,
    _defaults = {
        // elements
        twitter: '.tw-soc.ver1',
        fb: '.fb-soc.ver1',
        twitter2: '.tw-soc.ver2',
        fb2: '.fb-soc.ver2'
        // prop
        // data
        // classes ans styles
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
        // elements
        twitter: null,
        fb: null,
        twitter2: null,
        fb2: null,

        // prop
        preloaded: false
    },

    //PRIVATE METHODS
    _init = function() {
        appMakeBeCool.gateway.base.Class.apply(_sharrre, [_properties]);
        if(!_globals.preloaded) {
            return _sharrre.init();
        }
        _sharrre.globals.customCreate = function() {
            _config();
            _setup();
            _setBinds();
            _setCustomMethods();
        };
        _sharrre.create();
    },

    _config = function() {
        _globals.twitter = $(_properties.twitter);
        _globals.fb = $(_properties.fb);
        _globals.twitter2 = $(_properties.twitter2);
        _globals.fb2 = $(_properties.fb2);
    },

    _setup = function() {
        if(_globals.twitter.length) {
            _globals.twitter.sharrre({
                share: { twitter: true },
                url: $(this).data('url') != 'undefined' ? $(this).data('url') : '',
                text: $(this).data('text') != 'undefined' ? $(this).data('text') : '',
                enableHover: false,
                enableTracking: true,
                template: '<div class="tw-icon"></div><div class="numbers"><span class="triangle"></span><span class="tw-numbers">{total}</span></div>',
                click: function(api, options){
                    api.simulateClick();
                    api.openPopup('twitter');
                }
            });
        }
        if(_globals.fb.length) {
            _globals.fb.sharrre({
                share: { facebook: true },
                url: $(this).data('url') != 'undefined' ? $(this).data('url') : '',
                text: $(this).data('text') != 'undefined' ? $(this).data('text') : '',
                enableHover: false,
                enableTracking: true,
                template: '<div class="fb-icon"></div><div class="numbers"><span class="triangle"></span><span class="fb-numbers">{total}</span></div>',
                click: function(api, options){
                    api.simulateClick();
                    api.openPopup('facebook');
                }
            });
        }
        if(_globals.twitter2.length) {
            _globals.twitter2.sharrre({
                share: { twitter: true },
                url: $(this).data('url') != 'undefined' ? $(this).data('url') : '',
                text: $(this).data('text') != 'undefined' ? $(this).data('text') : '',
                enableHover: false,
                enableTracking: true,
                template: '<i class="fa fa-twitter"></i><span class="numbers"><span class="triangle"></span><span class="tw-numbers">{total}</span></span>',
                click: function(api, options){
                    api.simulateClick();
                    api.openPopup('twitter');
                }
            });
        }
        if(_globals.fb2.length) {
            _globals.fb2.sharrre({
                share: { facebook: true },
                url: $(this).data('url') != 'undefined' ? $(this).data('url') : '',
                text: $(this).data('text') != 'undefined' ? $(this).data('text') : '',
                enableHover: false,
                enableTracking: true,
                template: '<i class="fa fa-facebook"></i><span class="numbers"><span class="triangle"></span><span class="fb-numbers">{total}</span></span>',
                click: function(api, options){
                    api.simulateClick();
                    api.openPopup('facebook');
                }
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
        _sharrre.globals.customResurrect = function() {};
        _sharrre.globals.customDestroy = function() {};
    };

    //PUBLIC METHODS
    _sharrre.addMethod('init', function() {
        _sharrre.bind($window, _sharrre.globals.classType+'_Init', function(e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});