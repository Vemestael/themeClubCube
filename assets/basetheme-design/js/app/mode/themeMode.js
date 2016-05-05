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
      _globals.siteObj.utils.extend(_globals.siteObj.classes.Sliders, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.DtMenu, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.MenuAligns, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.GalleryFunctions, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.MasonryTiles, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.Parallax, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.ImgHover, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.SlickSlider, _globals.siteObj.base.Class);
      _globals.siteObj.utils.extend(_globals.siteObj.classes.Timer, _globals.siteObj.base.Class);


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
      _globals.siteObj.createClassInstance('Sliders', _globals.siteObj.classes.Sliders, {classId: 'Sliders'});
      _globals.siteObj.createClassInstance('DtMenu', _globals.siteObj.classes.DtMenu, {classId: 'DtMenu'});
      _globals.siteObj.createClassInstance('MenuAligns', _globals.siteObj.classes.MenuAligns, {classId: 'MenuAligns'});
      _globals.siteObj.createClassInstance('GalleryFunctions', _globals.siteObj.classes.GalleryFunctions, {classId: 'GalleryFunctions'});
      _globals.siteObj.createClassInstance('MasonryTiles', _globals.siteObj.classes.MasonryTiles, {classId: 'MasonryTiles'});
      _globals.siteObj.createClassInstance('Parallax', _globals.siteObj.classes.Parallax, {classId: 'Parallax'});
      _globals.siteObj.createClassInstance('ImgHover', _globals.siteObj.classes.ImgHover, {classId: 'ImgHover'});
      _globals.siteObj.createClassInstance('SlickSlider', _globals.siteObj.classes.SlickSlider, {classId: 'ImgHover'});
      _globals.siteObj.createClassInstance('Timer', _globals.siteObj.classes.Timer, {classId: 'ImgHover'});
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
            _themeMode.trigger('Sliders_Init', data);
            _themeMode.trigger('DtMenu_Init', data);
            _themeMode.trigger('MenuAligns_Init', data);
            _themeMode.trigger('GalleryFunctions_Init', data);
            _themeMode.trigger('MasonryTiles_Init', data);
            _themeMode.trigger('Parallax_Init', data);
            _themeMode.trigger('ImgHover_Init', data);
            _themeMode.trigger('SlickSlider_Init', data);
            _themeMode.trigger('Timer_Init', data);
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