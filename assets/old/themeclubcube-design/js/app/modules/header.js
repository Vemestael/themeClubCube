appMakeBeCool.gateway.addClass('Header', function (properties, $, $window, $document) {
  var _header = this,
    _defaults = {
      header: 'header',
      classFixed: 'fixed',
      classSmall: 'smaller'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
      header: null,
      small: false,
      tempScrollTop: 0,
      currentScrollTop: 0,
      fixedScrollTop: 150,
      preloaded: false
    },

  //PRIVATE METHODS
    _init = function () {
      appMakeBeCool.gateway.base.Class.apply(_header, [_properties]);
      if (!_globals.preloaded) {
        return _header.init();
      }
      _header.globals.customCreate = function () {
        _config();
        _setup();
        _setBinds();
        _setCustomMethods();
      };
      _header.create();
    },

    _config = function () {
      _globals.header = $(_properties.header);
    },

    _setup = function () {
    },

    _setBinds = function () {
      _binds().setScrollBinds();
      //_binds().setBtnNavBinds();
    },

    _binds = function () {
      return {
        setScrollBinds: function () {
          _header.bind($window, 'scroll', function (e, data, el) {
            _setClasses();
          });
        },
        setBtnNavBinds: function () {
          _header.bind(_globals.btnNav, 'click', function (e, data, el) {
            _globals.btnNav.toggleClass("active");
            _globals.containerNav.toggleClass("active");
          });
        }
      };
    },

    _triggers = function () {
      return {};
    },

    _setCustomMethods = function () {
      _header.globals.customResurrect = function () {
      };
      _header.globals.customDestroy = function () {
      };
      _setClasses = function (ob) {
        _globals.currentScrollTop = $window.scrollTop();
        if (_globals.tempScrollTop < _globals.currentScrollTop && _globals.currentScrollTop > _globals.fixedScrollTop) {
          _globals.header.addClass(_properties.classFixed);
        } else if (_globals.tempScrollTop > _globals.currentScrollTop) {
          _globals.header.removeClass(_properties.classFixed);
        }
        _globals.tempScrollTop = _globals.currentScrollTop;
        if ($window.scrollTop() > 10) {
          _globals.header.addClass(_properties.classSmall);
        } else if ($window.scrollTop() <= 10) {
          _globals.header.removeClass(_properties.classSmall);
        }
      };
    };

  _header.addMethod('init', function () {
    _header.bind($window, _header.globals.classType + '_Init', function (e, data, el) {
      _globals.preloaded = true;
      _init();
    });
  });

  //GO!
  _init();
});