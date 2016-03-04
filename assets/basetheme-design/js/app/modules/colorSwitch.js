"use strict";
appMakeBeCool.gateway.addClass('ColorSwitch', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _colorSwitch = this,
        _defaults = {
            // elements
            clrPicker: '.clr-picker',
            ptrn: '.pattern',
            linkItm: '[href^="css/skins/clr"]',
            linkItmPtrn: '[href^="css/skins/pattern"]',
            wideScrn: '.navbar__tint-wide'

        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            // elements
            clrPicker: null,
            ptrn: null,
            linkItm: null,
            linkItmPtrn: null,
            wideScrn: null,

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_colorSwitch, [_properties]);
            if (!_globals.preloaded) {
                return _colorSwitch.init();
            }
            _colorSwitch.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _colorSwitch.create();
        },

        _config = function () {
            _globals.clrPicker = $(_properties.clrPicker);
            _globals.ptrn = $(_properties.ptrn);
            _globals.linkItm = $(_properties.linkItm);
            _globals.linkItmPtrn = $(_properties.linkItmPtrn);
            _globals.wideScrn = $(_properties.wideScrn);
        },

        _setup = function () {

            _changeClr();
            _changePtrn();
            _loadSkin();
        },

        _setBinds = function () {
        },

        _binds = function () {
            return {
            }
        },

        _triggers = function () {
            return {}
        },

        _changeClr = function () {
            _globals.clrPicker.on('click', function () {

                if ($(this).hasClass('green')) {
                    _globals.linkItm.attr('href', 'css/skins/clr-green-violet.css');

                    if(typeof(Storage) !== "undefined") {
                        localStorage.removeItem("skin");
                        localStorage.setItem("skin", 'green');
                    }
                }
                if ($(this).hasClass('orange')) {
                   _globals.linkItm.attr('href', 'css/skins/clr-orange-red.css');

                    if(typeof(Storage) !== "undefined") {
                        localStorage.removeItem("skin");
                        localStorage.setItem("skin", 'orange');
                    }
                }
                if ($(this).hasClass('crimson')) {
                    _globals.linkItm.attr('href', 'css/skins/clr-crimson-cyan.css');

                    if(typeof(Storage) !== "undefined") {
                        localStorage.removeItem("skin");
                        localStorage.setItem("skin", 'crimson');
                    }
                }
                if ($(this).hasClass('yellow')) {
                    _globals.linkItm.attr('href', 'css/skins/clr-yellow-pink.css');

                    if(typeof(Storage) !== "undefined") {
                        localStorage.removeItem("skin");
                        localStorage.setItem("skin", 'yellow');
                    }
                }
                if ($(this).hasClass('brown')) {
                    _globals.linkItm.attr('href', 'css/skins/clr-brown-gray.css');

                    if(typeof(Storage) !== "undefined") {
                        localStorage.removeItem("skin");
                        localStorage.setItem("skin", 'brown');
                    }
                }
                _globals.clrPicker.removeClass('active');
                $(this).addClass('active');

            });
        },

        _loadSkin = function () {
            if(typeof(Storage) !== "undefined") {
                setTimeout( function() {

                    if (localStorage.getItem("skin") == ('orange')) {
                        _globals.linkItm.attr('href', 'css/skins/clr-orange-red.css');
                    }
                    if (localStorage.getItem("skin") == ('crimson')) {
                        _globals.linkItm.attr('href', 'css/skins/clr-crimson-cyan.css');
                    }
                    if (localStorage.getItem("skin") == ('yellow')) {
                        _globals.linkItm.attr('href', 'css/skins/clr-yellow-pink.css');
                    }
                    if (localStorage.getItem("skin") == ('brown')) {
                        _globals.linkItm.attr('href', 'css/skins/clr-brown-gray.css');
                    }
                    else {
                        console.log('error')
                    }
                }, 50)
            } else {
                alert('Sorry! No Web Storage support..')
            }

        },

        _changePtrn = function () {
            _globals.ptrn.on('click', function () {
                $('body').removeClass('circle triangle solid waves');

                if ($(this).hasClass('circle')) {
                     $('body').addClass('circle')
                }
                if ($(this).hasClass('triangle')) {
                    $('body').addClass('triangle')
                }
                if ($(this).hasClass('solid')) {
                    $('body').addClass('solid')
                }
                if ($(this).hasClass('waves')) {
                    $('body').addClass('waves')
                }
                else {
                    return false
                }

                //_globals.clrPicker.removeClass('active');
                //$(this).addClass('active');
            });
        },

        //_changeWide = function () {
        //    _globals.wideScrn.on('click', function () {
        //        _globals.wideScrn.removeClass('active');
        //        $(this).addClass('active');
        //    })
        //},

        _toggleMenuCheckup = function () {

        },

        _setCustomMethods = function () {
            _colorSwitch.globals.customResurrect = function () {
            };
            _colorSwitch.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _colorSwitch.addMethod('init', function () {
        _colorSwitch.bind($window, _colorSwitch.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});