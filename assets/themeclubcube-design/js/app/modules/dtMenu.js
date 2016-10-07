"use strict";
appMakeBeCool.gateway.addClass('DtMenu', function (properties, $, $window, $document) {
    //PRIVATE VARIABLES
    var _dtMenu = this,
        _defaults = {
            navigation: '#navigation'
            // elements
            // prop
            // data
            // classes ans styles
        },
        _properties = $.extend(_defaults, properties),
        _globals = {
            navigation: null,
            // elements

            // prop
            preloaded: false
        },

    //PRIVATE METHODS
        _init = function () {
            appMakeBeCool.gateway.base.Class.apply(_dtMenu, [_properties]);
            if (!_globals.preloaded) {
                return _dtMenu.init();
            }
            _dtMenu.globals.customCreate = function () {
                _config();
                _setup();
                _setBinds();
                _setCustomMethods();
            };
            _dtMenu.create();
        },

        _config = function () {
            _globals.navigation = $(_properties.navigation);
        },

        _setup = function () {
            _dtMenuFunc();
        },

        _setBinds = function () {
            //_binds().setClickLink();
        },

        _binds = function () {
            return {
                setClickLink: function () {
                    _dtMenu.bind($('.navbar-list li a'), 'click', function (e) {
                        //e.preventDefault();
                    });
                }
            };
        },

        _triggers = function () {
            return {};
        },

        _dtMenuFunc = function () {

            if (_globals.navigation.length && $window.width() < 1200) {

                //Init
                var $allLiIt = _globals.navigation.find('li i');
                var $allLi = _globals.navigation.find('li');
                var $topLi = _globals.navigation.children('li');
                var $submenu = _globals.navigation.find('.dl-submenu');
                var backNode = '<li class="dt-back"><a href="#"><i class="fa fa-angle-left"></i>Back</a>';

                $submenu.each(function () {
                    $(this).prepend(backNode);
                });

                var $backNodes = _globals.navigation.find('.dt-back');

                //Events
                $allLiIt.click(function () {
                    var $clickedLiIt = $(this);
                    var $clickedLi = $clickedLiIt.closest('li');
                    var $parentUl = $clickedLi.closest('ul');
                    if ($parentUl.hasClass('dl-menu')) {
                        var $nextUl = $clickedLi.children('ul');
                        var $nextDiv = $('.mega-menu');
                        var $parentLi = $clickedLi.closest('li.subviewopen');
                        if ($nextUl.length) {
                            $clickedLi.addClass('subviewopen');
                            $parentUl.addClass('subview');
                        }
                        else if ($nextDiv.length) {
                            $clickedLi.addClass('subviewopen');
                            $parentUl.addClass('subview');
                        }
                    } else {
                        var $nextUl = $clickedLi.children('ul');
                        var $parentLi = $clickedLi.closest('li.subviewopen');
                        if ($parentLi.hasClass('subviewopen')) {
                            $parentLi.removeClass('subviewopen');
                            $parentLi.addClass('subview');
                            $clickedLi.addClass('subviewopen');
                        }
                    }
                    console.log('Nope');
                    return false;
                });

                $backNodes.click(function () {
                    var $backLink = $(this);
                    var $parentLi = $(this).closest('li.subviewopen');
                    var $parentUl = $parentLi.closest('ul');

                    if ($parentUl.hasClass('dl-submenu')) {
                        var $upperLi = $parentUl.closest('li');
                        $parentLi.removeClass('subviewopen');
                        $upperLi.addClass('subviewopen');
                    }
                    else {
                        $parentUl.removeClass('subview');
                        $parentLi.removeClass('subviewopen');
                    }

                    return false;
                });

            }
        },

        _setCustomMethods = function () {
            _dtMenu.globals.customResurrect = function () {
            };
            _dtMenu.globals.customDestroy = function () {
            };
        };

    //PUBLIC METHODS
    _dtMenu.addMethod('init', function () {
        _dtMenu.bind($window, _dtMenu.globals.classType + '_Init', function (e, data, el) {
            _globals.preloaded = true;
            _init();
        });
    });

    //GO!
    _init();
});