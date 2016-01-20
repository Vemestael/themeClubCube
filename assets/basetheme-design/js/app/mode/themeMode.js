"use strict";
appMakeBeCool.gateway.addClass('ThemeMode', function (properties, $, $window, $document) {
  //PRIVATE VARIABLES
  var _themeMode = this,
    _defaults = {
      // classes ans styles
      classMode: 'theme-mode'
    },
    _properties = $.extend(_defaults, properties),
    _globals = {
      siteObj: null,
      preloaded: false
    },

  //PRIVATE METHODS
    _init = function () {
      appMakeBeCool.gateway.classes.SiteMode.apply(_themeMode, [_properties])
      if (!_globals.preloaded) {
        return _themeMode.init();
      }
      _config();
      _extendClasses();
      _instantiateClasses();
      _setup();
      _setBinds();
      _setCustomMethods();
      _themeMode.trigger(_themeMode.globals.classType + '_Complete');
    },

    _config = function () {
      _globals.siteObj = _themeMode.getSiteObj();
    },

    _extendClasses = function () {

      _globals.siteObj.utils.extend(_globals.siteObj.classes.BgImages, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.FormValidate, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.FormAjax, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.HeaderFunctions, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.Custom, _globals.siteObj.base.Class);


    },

    _instantiateClasses = function () {
      _globals.siteObj.createClassInstance('bgImages', _globals.siteObj.classes.BgImages, {classId: 'BgImages'});
      _globals.siteObj.createClassInstance('FormValidate', _globals.siteObj.classes.FormValidate, {
        classId: 'FormValidate',
        forms: []
      });
      _globals.siteObj.createClassInstance('FormAjax', _globals.siteObj.classes.FormAjax, {
        classId: 'FormAjax',
        forms: []
      });
      _globals.siteObj.createClassInstance('HeaderFunctions', _globals.siteObj.classes.HeaderFunctions, {classId: 'HeaderFunctions'});
      _globals.siteObj.createClassInstance('Custom', _globals.siteObj.classes.Custom, {classId: 'Custom'});
    },

    _setup = function () {
      $('body').addClass(_properties.classMode);
    },

    _setBinds = function () {
      _binds().setCompleteBind();

    },

    _binds = function () {
      return {
        setCompleteBind: function () {
          _themeMode.bind($window, _themeMode.globals.classType + '_Complete', function (e, data) {
            _themeMode.trigger('BgImages_Init', data);
            _themeMode.trigger('FormValidate_Init', data);
            _themeMode.trigger('FormAjax_Init', data);
            _themeMode.trigger('HeaderFunctions_Init', data);
            _themeMode.trigger('Custom_Init', data);
          });
        }
      }
    },

    _setCustomMethods = function () {
      _themeMode.globals.customResurrect = function () {
      };
      _themeMode.globals.customDestroy = function () {
      };
    };

  //PUBLIC METHODS
  _themeMode.addMethod('init', function () {
    _themeMode.bind($window, 'siteConfigComplete', function () {
      _globals.preloaded = true;
      _init();
    });
  });

  //GO!
  _init();
});