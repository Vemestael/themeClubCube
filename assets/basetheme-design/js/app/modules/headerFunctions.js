"use strict";
appMakeBeCool.gateway.addClass('HeaderFunctions', function (properties, $, $window, $document) {
  //PRIVATE VARIABLES
  var _headerFunctions = this,
    _defaults = {
      header: '#header',
      navbar: '#navbarCollapse',
      navbarToggle: '#navbarToogle'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
      header: null,
      navbar: null,
      navbarToggle: null,
      // prop
      preloaded: false
    },

  //PRIVATE METHODS
    _init = function () {
      appMakeBeCool.gateway.base.Class.apply(_headerFunctions, [_properties]);
      if (!_globals.preloaded) {
        return _headerFunctions.init();
      }
      _headerFunctions.globals.customCreate = function () {
        _config();
        _setup();
        _setBinds();
        _setCustomMethods();
      };
      _headerFunctions.create();
    },

    _config = function () {
      _globals.header = $(_properties.header);
      _globals.navbar = $(_properties.navbar);
      _globals.navbarToggle = $(_properties.navbarToggle);

    },

    _setup = function () {
    },

    _setBinds = function () {
      _binds().setNavbarToggle();
    },

    _binds = function () {
      return {
        setNavbarToggle: function () {
          _headerFunctions.bind(_globals.navbarToggle, 'click', function (e, data, el) {
            _headerFunctions.globals.navbarToggle();
          });
        }
      };
    },

    _triggers = function () {
      return {};
    },

    _setCustomMethods = function () {
      _headerFunctions.globals.customResurrect = function () {
      };
      _headerFunctions.globals.customDestroy = function () {
      };
      _headerFunctions.globals.navbarToggle = function () {
        if (_globals.header.hasClass('header--toggled')) {
          _globals.navbar.removeClass('active');
          _globals.header.removeClass('header--toggled');
        } else {
          _globals.navbar.addClass('active');
          _globals.header.addClass('header--toggled');
        }
      };
    };

  //PUBLIC METHODS
  _headerFunctions.addMethod('init', function () {
    _headerFunctions.bind($window, _headerFunctions.globals.classType + '_Init', function (e, data, el) {
      _globals.preloaded = true;
      _init();
    });
  });

  //GO!
  _init();
});