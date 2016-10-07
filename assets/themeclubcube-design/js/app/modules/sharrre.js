appMakeBeCool.gateway.addClass('Sharrre', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _sharrre = this,
        _defaults = {
            // elements
            tw: '.n-tw',
            fb: '.n-fa',
            vk: '.n-vk'
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            tw: null,
            fb: null,
            vk: null,

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_sharrre, [_properties]);
            if (!_globals.preloaded) {
                return _sharrre.init();
            }
            _sharrre.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _sharrre.create();
        },

        _config = function () {
            _globals.tw = $(_properties.tw);
            _globals.fb = $(_properties.fb);
            _globals.vk = $(_properties.vk);
        },

        _setup = function () {
            if (_globals.tw.length) {
                _globals.tw.sharrre({
                    share: {twitter: true},
                    url: $(this).data('url') != 'undefined' ? $(this).data('url') : '',
                    text: $(this).data('text') != 'undefined' ? $(this).data('text') : '',
                    enableHover: false,
                    enableTracking: true,
                    //template: '<div class="tw-icon"></div><div class="numbers"><span class="triangle"></span><span class="tw-numbers">{total}</span></div>',
                    template: '<span class="fa fa-twitter"></span>',
                    click: function (api, options) {
                        api.simulateClick();
                        api.openPopup('twitter');
                    }
                });
            }
            if (_globals.fb.length) {
                _globals.fb.sharrre({
                    share: {facebook: true},
                    url: $(this).data('url') != 'undefined' ? $(this).data('url') : '',
                    text: $(this).data('text') != 'undefined' ? $(this).data('text') : '',
                    enableHover: false,
                    enableTracking: true,
                    template: '<span class="fa fa-facebook"></span>',
                    click: function (api, options) {
                        api.simulateClick();
                        api.openPopup('facebook');
                    }
                });
            }

            if (_globals.vk.length) {
                _globals.vk.html(VK.Share.button(window.location.href, {
                    noparse: true,
                    type: 'custom',
                    text: '<span class="fa fa-vk"></span>'
                }));
            }
        },

        _setBinds = function () {

        },

        _binds = function () {
            return {

            };
        },

        _triggers = function () {
            return {};
        },

        _setCustomMethods = function () {
            _sharrre.globals.customResurrect = function () {
            };
            _sharrre.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _sharrre.addMethod('init', function () {
        _sharrre.bind($window, _sharrre.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});